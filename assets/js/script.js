(function ($) {
  var header = $('.home header');
  $(window).on('scroll load', function () {
    if (window.scrollY > 100) header.addClass('scrolled');
    else header.removeClass('scrolled');
  });
})(jQuery);
