
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('registerForm');

    form.addEventListener('submit', function (event) {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirmPassword').value;
        const email = document.getElementById('email').value;

        if (password.length < 6) {
            alert('En az 6 karakter olmalıdır.');
            event.preventDefault();
        }

        if (password !== confirmPassword) {
            alert('Şifre eşleşmiyor.');
            event.preventDefault();
        }

        const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
        if (!email.match(emailPattern)) {
            alert('E-posta adresi giriniz.');
            event.preventDefault();
        }
    });
});
