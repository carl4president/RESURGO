const showPopupBtn = document.querySelector(".login-btn");
const formPopups = document.querySelectorAll(".form-popup");
const closeButtons = document.querySelectorAll(".close-btn");
const signupLoginLinks = document.querySelectorAll(".bottom-link a");
const attendanceLink = document.querySelector(".attendance-link");

showPopupBtn.addEventListener("click", () => {
    document.body.classList.toggle("show-popup");
});

closeButtons.forEach(button => {
    button.addEventListener("click", () => {
        document.body.classList.remove("show-popup");
    });
});

signupLoginLinks.forEach(link => {
    link.addEventListener("click", (e) => {
        e.preventDefault();
        formPopups.forEach(popup => {
            popup.classList.remove("show-signup");
        });
        if (link.id === 'signup-link') {
            link.closest('.form-popup').classList.add("show-signup");
        }
    });
});

attendanceLink.addEventListener("click", (e) => {
    e.preventDefault();
    window.location.href = e.target.getAttribute("href");
});
