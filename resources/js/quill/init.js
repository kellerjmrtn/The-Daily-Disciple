import Quill from 'quill';

// Create a new input element and append it to the form
const createNewInput = (form, name, className) => {
    const input = document.createElement('input');

    input.type = 'hidden';
    input.name = name;
    input.classList.add(className);

    form.appendChild(input);

    return input;
};

// Create a Quill instance in the given container
const createQuill = (container) => {
    return new Quill(container, {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'header': [3, 4, 5, 6, false] }],
                ['bold', 'italic', 'underline'],
                ['blockquote', 'code-block'],
                [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                ['clean']  // Remove formatting button
            ]
        }
    });
};

// Initialize a quill editor for each form field. When the form is submitted, append the quill
// content to a hidden field in the form, submitting the data
const init = () => {
    document.querySelectorAll('.quill-editor').forEach((editor) => {
        const form = editor.closest('form');
        const quill = createQuill(editor);

        form.addEventListener('submit', (e) => {
            const className = `quill-input-${editor.dataset.name}`;
            const input = form.querySelector(`.${className}`) || createNewInput(form, editor.dataset.name, className);

            // Replace nbsp with ' '. Not sure why quill adds these for every spacebar
            input.value = quill.getSemanticHTML().replace(/&nbsp;/g, ' ');
        });
    });
};

export default init;
