class Navigation {
    constructor() {
        this.mobileNav = document.querySelector(".hamburger");
        this.navbar = document.querySelector(".dropdown_menu");

        this.initEvents();
    }

    toggleNav() {
        this.navbar.classList.toggle("open");
        this.mobileNav.classList.toggle("hamburger-active");
    }

    initEvents() {
        if (this.mobileNav) {
            this.mobileNav.addEventListener("click", () => this.toggleNav());
        }
    }
}

// Export the Navigation class for use in other files
export default Navigation;
