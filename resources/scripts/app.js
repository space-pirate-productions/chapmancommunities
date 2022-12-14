import { domReady } from '@roots/sage/client';
import 'bootstrap';
import lozad from 'lozad';
// import multiLevelDropdown from './components/multi-level-dropdown';
import homeIconCtaSlider from './components/home-icon-cta-slider';
import iconCtaSlider from './components/icon-cta-slider';
import locationMap from './components/location-page-map';
import stickyNav from './components/sticky-nav';
import teamsSlider from './components/team-directory-slider';
import testimonialSlider from './components/testimonial-slider';
import videoModal from './components/video-modal';


/**
 * app.main
 */
const main = async (err) => {
  if (err) {
    // handle hmr errors
    console.error(err);
  }

  // application code
  const observer = lozad('.lozad', {
    rootMargin: '500px 0px',
    threshold: 0.1,
    load: function(el) {
      el.src = el.dataset.src;
    },
  });
  observer.observe();

  // multiLevelDropdown.init();

  homeIconCtaSlider.init();

  videoModal.init();

  teamsSlider.init();

  iconCtaSlider.init();

  testimonialSlider.init();

  locationMap.init();

  stickyNav.init();
};

/**
 * Initialize
 *
 * @see https://webpack.js.org/api/hot-module-replacement
 */
domReady(main);
import.meta.webpackHot?.accept(main);
