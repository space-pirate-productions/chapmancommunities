import Splide from "@splidejs/splide";
import $ from "jquery";

const teamsSlider = {
  init() {
    let navigationSettings = {
      isNavigation: true,
      autoWidth: true,
      arrows: false,
      pagination: false,
      drag: false,
      updateOnMove: true,
      snap: true,
      focus: "center",
    };
    let directorySettings = {
      type: "fade",
      arrows: false,
      pagination: false,
      drag: false,
    };

    let navSlider = $("#cc-team-locations");
    let dirSlider = $("#cc-team-members");

    let navigation = null;
    let directory = null;

    function adjustSlides() {
      let totalSlideWidth = null;
      let slideContainerWidth = $("#cc-team-locations-list").innerWidth();
      let slides = $("#cc-team-locations.is-active").find(
        ".cc-team-directory__location"
      );
      slides.each(function () {
        let slideWidth = $(this).outerWidth(false);
        totalSlideWidth += slideWidth;
      });

      if (Math.floor(totalSlideWidth) > Math.floor(slideContainerWidth)) {
        if (navigation.options.arrows == false) {
          navigation.options = {
            arrows: true,
            drag: "free",
          };
        }
      } else {
        if (navigation.options.arrows == true) {
          navigation.options = {
            arrows: false,
            drag: false,
          };
        }
      }
    }

    if (navSlider.length > 0 && dirSlider.length > 0) {
      navigation = new Splide("#cc-team-locations", navigationSettings);
      directory = new Splide("#cc-team-members", directorySettings);
      navigation.sync(directory);
      navigation.mount();
      directory.mount();

      $(window).on("load resize", function () {
        adjustSlides();
      });
    }
  },
};

export default teamsSlider;
