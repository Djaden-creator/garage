//form login conts
const passwordfilter = document.querySelector(".formlog input[type='password']"),
    toggleBtn = document.querySelector('.formlog i');

//user register form
const passwordfi = document.querySelector(".formreg input[type='password']"),
    toggleB = document.querySelector('.formreg i');

//login form
toggleBtn.onclick = () => {
    if (passwordfilter.type == "password") {
        passwordfilter.type = "text";
        toggleBtn.classList.add("active");
    } else {
        passwordfilter.type = "password";
        toggleBtn.classList.remove("password");
    }
}

//user register form password
toggleB.onclick = () => {
    if (passwordfi.type == "password") {
        passwordfi.type = "text";
        toggleB.classList.add("active");
    } else {
        passwordfi.type = "password";
        toggleB.classList.remove("password");
    }
}