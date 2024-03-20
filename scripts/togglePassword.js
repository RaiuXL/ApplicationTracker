
// Select the toggle password icon and the password input field
const togglePassword = document.querySelector('#togglePassword');
const password = document.querySelector('#password');

// Add a click event listener to the toggle password icon
togglePassword.addEventListener('click', function (e) {
  // Toggle the eye/slash icon
  this.classList.toggle('fa-eye-slash');

  // Switch the input field type between 'password' and 'text'
  if (password.type === 'password') {
    password.type = 'text';  // Show the password
  } else {
    password.type = 'password';  // Hide the password
  }
});
