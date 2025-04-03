import App from "./classes/App.js";

//Loader of the page
window.addEventListener("load", () => {
    const loader = document.querySelector(".loader");

    if (!loader) return;

    loader.classList.add("loader-hidden");

    loader.addEventListener("transitionend", () => {
        loader.remove(); 
    });
});

//The entire app
document.addEventListener("DOMContentLoaded", () => {
    const app = new App();
});
