(function($, window, document) {
  $(document).ready(function () {
    $('.td-content-wrap').attr('data-post-url', decodeURI(window.location.href));
  });
})(jQuery, window, document);
