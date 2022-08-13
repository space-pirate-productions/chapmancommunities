import Splide from "@splidejs/splide";
import $ from "jquery";

const iconCtaSlider = {
  init() {
    let iconSliders = $(".cc-icon-cta__slider--mobile");

    $.each(iconSliders, function (index, element) {
      new Splide(element, {
        mediaQuery: "min",
        type: "loop",
        breakpoints: {
          768: {
            destroy: "true",
          },
        },
      }).mount();
    });
  },
};

export default iconCtaSlider;
