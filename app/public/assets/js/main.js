console.log("hello from js!");
function toggleForm(formType) {
    const signUpForm = document.getElementById('signUpForm');
    const loginForm = document.getElementById('loginForm');

    if (formType === 'login') {
        signUpForm.classList.add('d-none');
        loginForm.classList.remove('d-none');
    } else if (formType === 'signup') {
        loginForm.classList.add('d-none');
        signUpForm.classList.remove('d-none');
    }
}