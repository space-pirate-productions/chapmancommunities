import $ from 'jquery';

const videoModal = {
  init() {
    // cribbed from: https://stackoverflow.com/questions/18622508/bootstrap-3-and-youtube-in-modal#answer-66258882
    let triggerOpen = $("body").find('[data-tagVideo]');

    triggerOpen.click(function() {
      let theModal = $(this).data("bs-target"),
      videoSRC = $(this).attr('data-tagVideo'),
      videoSRCauto = videoSRC + "?autoplay=1";
      $(theModal + ' iframe').attr('src', videoSRCauto);
      $(theModal).on('hide.bs.modal', function(event) {
        $(theModal + ' iframe').attr('src', videoSRC);
      })
    })
  }
}

export default videoModal;
