//user register form
const passwordfi = document.querySelector(".formreg input[type='password']"),
    toggleB = document.querySelector('.formreg i');
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