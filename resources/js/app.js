import './bootstrap';

import Alpine from 'alpinejs';

import initCustomQuill from './quill/init';

window.Alpine = Alpine;

Alpine.start();

const checkScrolled = (element) => {
    if (window.scrollY > 0) {
        document.body.classList.add('scrolled');
        element.classList.add('scrolled');
    } else {
        document.body.classList.remove('scrolled');
        element.classList.remove('scrolled');
    }
};

// Add scrolled class to nav on page scroll
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.main-nav').forEach((element) => {
        document.addEventListener('scroll', () => checkScrolled(element));
        checkScrolled(element);
    });
});

// When clicking copy button, place verse text into clipboard
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.verse-container').forEach((element) => {
        const verseText = element.querySelector('.verse-text').textContent.trim();
        const reference = element.querySelector('.verse-reference').textContent.trim();

        element.querySelectorAll('.copy-text').forEach((copyText) => {
            copyText.addEventListener('click', () => {
                navigator.clipboard.writeText(`${verseText}\n\n${reference}`);
            });
        });
    });
});

// When clicking the copy link button, place URL into clipboard
document.addEventListener('DOMContentLoaded', () => {
    const url = location.href.split('#')[0];

    document.querySelectorAll('.devotion-heading').forEach((element) => {
        element.querySelectorAll('.heading-link').forEach((inner) => {
            inner.addEventListener('click', () => {
                navigator.clipboard.writeText(`${url}#${element.id}`);
            });
        });
    });
});

/**
 * Toggle the given devotional cards on and off, and scroll the main card into view
 */
const toggleCards = (card, cards) => {
    cards.forEach((singleCard) => {
        singleCard.classList.toggle('toggled');
    })

    card.scrollIntoView({
        behavior: 'smooth',
    });
}

/**
 * Is the client mobile width or doesn't support hover effects?
 */
const isMobile = () => window.innerWidth < 1024 || !window.matchMedia('(hover: hover)');

/**
 * Apply click effects for the given devotional cards. All given cards will be toggled together.
 * Click effects will do nothing on non-mobile devices, and link behavior will be observed 
 */
const applyCardClickEffects = (cards) => {
    cards.forEach((card) => {
        const readMore = card.querySelector('.read-more');

        card.addEventListener('click', (e) => {
            // If not mobile, no click effects are needed
            if (!isMobile()) {
                return;
            }

            // If the .read-more element was clicked on, or the card has not yet been toggled,
            // toggle it. Otherwise, do nothing, and allow standard link behavior
            if (readMore.contains(e.target) || !card.classList.contains('toggled')) {
                e.preventDefault();

                toggleCards(card, cards);
            }
        });
    });
};

/**
 * Add devotional card "toggle" functionality. In sliders, toggling one slider toggles all cards in
 * the slider. On mobile, clicking the card will first toggle the card. Then, when already toggled
 * open, clicking the card will act as a link
 */
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.devotional-card-container.slider').forEach((slider) => {
        const cards = slider.querySelectorAll('.devotional-card');

        applyCardClickEffects(cards);
    });

    document.querySelectorAll('.devotional-card-container:not(.slider)').forEach((container) => {
        container.querySelectorAll('.devotional-card').forEach((card) => {
            applyCardClickEffects([card]);
        });
    });
});

// Maintain a reference to all hover listeners. This way, they can each be removed before adding
// new ones
let allListeners = [];

/**
 * This method manually resizes devotional cards and sets event listeners for hover effects
 */
const resize = (container) => {
    const cards = container.querySelectorAll('.devotional-card');

    // Remove all listeners on cards
    cards.forEach((card) => {
        allListeners.forEach((listener) => {
            card.removeEventListener('mouseover', listener);
            card.removeEventListener('mouseout', listener);
        });
    });

    allListeners = [];

    // If the browser is mobile or other non-hover devices, ensure all hover effects are removed
    if (isMobile()) {
        container.querySelectorAll('.devotional-card').forEach((card) => {
            card.style.removeProperty('height');

            card.querySelector('.card-middle').style.removeProperty('margin-top');
            card.querySelector('.card-upper').style.top = 0;
            card.querySelector('.excerpt').style.removeProperty('height');
        });

        return;
    }

    // In each container, grab the first card and measure it's width, then calculate height
    // as 64.5% of width
    const height = Math.max(300, container.querySelector('.devotional-card').offsetWidth * 0.645);

    // Then, grab all cards and set height and margins. These set initial values, and then
    // "animations" are triggered with mouseover/mouseout effects
    container.querySelectorAll('.devotional-card').forEach((card) => {
        // Set overall card height
        card.style.height = `${height}px`;

        // Get titles container height
        const titlesContainerHeight = card.querySelector('.titles').offsetHeight;

        // Get card top height
        const cardTopHeight = card.querySelector('.card-top').offsetHeight;

        // Set middle element margin - 2rem is for the padding of the card
        card.querySelector('.card-middle').style.marginTop = `calc(${height - titlesContainerHeight - cardTopHeight}px - 2rem)`;
        
        // Add card listeners to create hover animations/effects
        const cardUpperContainer = card.querySelector('.card-upper');

        const onMouseOver = () => {
            cardUpperContainer.style.top = `calc(-${height - titlesContainerHeight}px + 2rem)`;
            card.classList.add('hovered');
        }
        
        const onMouseOut = () => {
            cardUpperContainer.style.top = 0;
            card.classList.remove('hovered');
        };

        card.addEventListener('mouseover', onMouseOver);
        card.addEventListener('mouseout', onMouseOut);

        allListeners.push(onMouseOver, onMouseOut);

        // Set excerpt height
        const goToButtonHeight = card.querySelector('.go-to-link').offsetHeight;
        const excerptContainer = card.querySelector('.excerpt');

        excerptContainer.style.height = `calc(${height - goToButtonHeight - titlesContainerHeight}px - 4rem)`;
    });
}

// Add resize calls for devotional card containers for initial load, delayed load (after fonts), and resize
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.devotional-card-container').forEach((container) => {
        resize(container);
    });
});

document.fonts.ready.then(() => {
    document.querySelectorAll('.devotional-card-container').forEach((container) => {
        resize(container);
    });
});

window.addEventListener('resize', () => {
    document.querySelectorAll('.devotional-card-container').forEach((container) => {
        resize(container);
    });
})

// Initialize quill on any quill inputs on the page
document.addEventListener('DOMContentLoaded', () => {
    initCustomQuill();
});
