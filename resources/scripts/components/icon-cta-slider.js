import Splide from "@splidejs/splide";
import $ from "jquery";

const iconCtaSlider = {
  init() {
    var elms = document.getElementsByClassName("cc-slider--mobile");

    for (var i = 0; i < elms.length; i++) {
      new Splide(elms[i], {
        mediaQuery: 'min',
        type: 'loop',
        breakpoints: {
          768: {
            destroy: 'true'
          }
        }
      }).mount();
    }
  },
};

export default iconCtaSlider;
