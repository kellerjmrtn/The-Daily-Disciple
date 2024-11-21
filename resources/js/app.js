import './bootstrap';

const checkScrolled = (element) => {
    if (window.scrollY > 0) {
        element.classList.add('scrolled');
    } else {
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
