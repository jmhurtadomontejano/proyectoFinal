// form.js

console.log('form.js loaded');

document.addEventListener('DOMContentLoaded', function () {
    var inputs = document.querySelectorAll('.form-group input, .form-group textarea, .form-group select');

    inputs.forEach(function (input) {
        if (input.value.trim() !== '') {
            input.classList.add('not-empty');
        }

        input.addEventListener('focus', function () {
            input.classList.add('not-empty');
        });

        input.addEventListener('blur', function () {
            if (input.value.trim() === '') {
                input.classList.remove('not-empty');
            }
        });
    });
});
