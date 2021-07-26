(function ($) {
  var header = $('.home header');
  $(window).on('scroll load', function () {
    if (window.scrollY > 100) header.addClass('scrolled');
    else header.removeClass('scrolled');
  });
  $('#filtre-recrutement').on('change', function (e) {
    $(this).submit();
  });
})(jQuery);
