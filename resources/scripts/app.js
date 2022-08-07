import {domReady} from '@roots/sage/client';
import 'bootstrap';
import lozad from 'lozad';
import iconCtaSlider from './components/sliders';
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

  iconCtaSlider.init();

  videoModal.init();
};

/**
 * Initialize
 *
 * @see https://webpack.js.org/api/hot-module-replacement
 */
domReady(main);
import.meta.webpackHot?.accept(main);
