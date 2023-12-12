const container = document.querySelector(".container");
const pwShowHide = document.querySelectorAll(".showHidePw");
const pwFields = document.querySelectorAll(".password");
const signUp = document.querySelector(".signup-link");
const login = document.querySelector(".login-link");

// JS code to show and hide a password
pwShowHide.forEach(eye => {
  eye.addEventListener("click", () => {
    pwFields.forEach(pwField => {
      if (pwField.type === "password") {
        pwField.type = "text";

        pwShowHide.forEach(icon => {
          icon.classList.replace("fa-eye", "fa-lock");
        });
      } else {
        pwField.type = "password";

        pwShowHide.forEach(icon => {
          icon.classList.replace("fa-lock", "fa-eye");
        });
      }
    });
  });
});

// JS code to appear the signup and login form
signUp.addEventListener("click", () => {
  container.classList.add("active");
});

login.addEventListener("click", () => {
  container.classList.remove("active");
});
