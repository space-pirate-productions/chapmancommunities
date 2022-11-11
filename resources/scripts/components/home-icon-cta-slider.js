import Splide from "@splidejs/splide";
import $ from "jquery";

const homeIconCtaSlider = {
  init() {
    var elms = document.getElementsByClassName("cc-slider--mobile");

    if (elms.length > 0) {
      for (var i = 0; i < elms.length; i++) {
        new Splide(elms[i], {
          mediaQuery: "min",
          type: "loop",
          perMove: 1,
          perPage: 1,
          autoplay: true,
          breakpoints: {
            768: {
              destroy: "true",
            },
          },
        }).mount();
      }
    }
  },
};

export default homeIconCtaSlider;
