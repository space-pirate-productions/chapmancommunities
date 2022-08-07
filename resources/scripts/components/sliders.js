import Splide from "@splidejs/splide";

// const iconCtaSlider = new Splide(".cc-slider", {
//   mediaQuery: 'min',
//   type: 'loop',
//   breakpoints: {
//     768: {
//       destroy: true
//     }
//   }
// });

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
