class Slider {
    constructor(sliderSelector) {
        this.sliderContainer = document.querySelector(sliderSelector);
        this.slides = this.sliderContainer.querySelectorAll(".mySlides");
        this.dots = this.sliderContainer.querySelectorAll(".dot");
        this.currentSlideIndex = 0;

        this.showSlide(this.currentSlideIndex);

        // Adding event listeners to navigation buttons
        this.sliderContainer.querySelector(".prev").addEventListener("click", () => this.changeSlide(-1));
        this.sliderContainer.querySelector(".next").addEventListener("click", () => this.changeSlide(1));
        
        // Adding event listeners to dots
        this.dots.forEach((dot, index) => {
            dot.addEventListener("click", () => this.showSlide(index));
        });
    }

    // Method to show a specific slide
    showSlide(index) {
        // Reset to loop slides
        if (index >= this.slides.length) {
            this.currentSlideIndex = 0;
        } else if (index < 0) {
            this.currentSlideIndex = this.slides.length - 1;
        } else {
            this.currentSlideIndex = index;
        }

        // Hide all slides
        this.slides.forEach(slide => slide.style.display = "none");

        // Remove "active" class from all dots
        this.dots.forEach(dot => dot.classList.remove("active"));

        // Display the current slide and set the active dot
        this.slides[this.currentSlideIndex].style.display = "block";
        this.dots[this.currentSlideIndex].classList.add("active");
    }

    // Method to change slides
    changeSlide(n) {
        this.showSlide(this.currentSlideIndex + n);
    }
}


export default Slider;
