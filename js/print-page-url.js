(function($, window, document) {
  $(document).ready(function () {
    $('.td-page-wrap, .post .meta-info').attr('data-post-url', decodeURI(window.location.href));
  });
})(jQuery, window, document);
