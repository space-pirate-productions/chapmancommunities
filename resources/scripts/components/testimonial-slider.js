import Splide from "@splidejs/splide";
import $ from "jquery";

const testimonialSlider = {
  init() {
    let testimonial = $(".cc-testimonials__slider");

    $.each(testimonial, function (index, element) {
      let slide = $(this).find(".cc-testimonials__testimonial");
      let arrows = slide.length <= 1 ? false : true;

      new Splide(element, {
        type: "fade",
        rewind: true,
        perPage: 1,
        perMove: 1,
        drag: false,
        arrows: arrows,
        pagination: arrows,
      }).mount();
    });
  },
};

export default testimonialSlider;
