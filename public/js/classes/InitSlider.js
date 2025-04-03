import Slider from "./Slider.js";

class InitSlider {
    constructor() {
        // Initialize the Navigation class
        this.slider = new Slider(".carousel-main-section");
    }
}


// Run it directly
document.addEventListener("DOMContentLoaded", () => {
    new InitSlider();
});

export default InitSlider;
