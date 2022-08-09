import Splide from '@splidejs/splide';
import $ from 'jquery';

const teamsSlider = {
  init() {
    let locationCount = $('#cc-team-locations').find('.cc-team-directory__location').length;
    let navigationSettings = {
      isNavigation: true,
      autoWidth: true,
      arrows: false,
      pagination: false,
    };
    let directorySettings = {
      type: 'fade',
      arrows: false,
      pagination: false,
    };

    let navigation = new Splide('#cc-team-locations', navigationSettings);
    let directory = new Splide('#cc-team-members', directorySettings);

    navigation.sync(directory);
    navigation.mount();
    directory.mount();
  }
};

export default teamsSlider;
