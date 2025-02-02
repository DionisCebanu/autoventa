import App from "./classes/App.js";

//Loader of the page
window.addEventListener("load", () => {
    const loader = document.querySelector(".loader");

    loader.classList.add("loader-hidden");

    loader.addEventListener("transitionend", () => {
        document.body.removeChild("loader");
    });
})


//The entire app
document.addEventListener("DOMContentLoaded", () => {
    const app = new App();
});
