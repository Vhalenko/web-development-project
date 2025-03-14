const loginButton = document.getElementById('loginButton');
const signUpButton = document.getElementById('signUpButton');
const usernameTextField = document.getElementById('username');
const passwordTextField = document.getElementById('password');
const emailTextField = document.getElementById('email');

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

// function login() {
//     username = usernameTextField.textContent
// }

// function signUp() {

// }

// loginButton.addEventListener("click", async function() {
//     const username = usernameTextField.value.trim(); 
//     const password = passwordTextField.value.trim(); 

//     const response = await fetch('http://localhost/api/users/login', { 
//         method: "GET",
//         headers: {
//             "Content-Type": "application/json"
//         },
//         body: JSON.stringify({
//             username: username,
//             password: password
//         })
//     });

//     const data = await response.json(); // Convert response to JSON

//     console.log(response);
// })

// signUpButton.addEventListener("click", async function() {
//     event.preventDefault(); // Prevent default form submission

//     const username = document.getElementById("username").value;
//     const email = document.getElementById("email").value;
//     const password = document.getElementById("password").value;

//     try {
//         const response = await fetch("http://localhost/api/users", {
//             method: "POST",
//             headers: {
//                 "Content-Type": "application/json"
//             },
//             body: JSON.stringify({
//                 username: username,
//                 email: email,
//                 password: password
//             })
//         });

//         if (response.ok) {
//             console.log(response);
//             alert("Sign-up successful! You can now log in.");
//             //window.location.href = "/login"; // Redirect to login page
//         } else {
//             alert("Error: " + response);
//         }
//     } catch (error) {
//         console.error("Error:", error);
//         alert(error);
//     }
// })