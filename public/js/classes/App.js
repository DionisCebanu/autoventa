import Navigation from "./Navigation.js";
import Slider from "./Slider.js";

class App {
    constructor() {
        // Initialize the Navigation class
        this.navigation = new Navigation();
        this.Slider = new Slider(".carousel-main-section");
    }
}

export default App;
