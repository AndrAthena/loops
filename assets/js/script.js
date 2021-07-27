(function ($) {
  var header = $('.home header');
  $(window).on('scroll load', function () {
    if (window.scrollY > 100) header.addClass('scrolled');
    else header.removeClass('scrolled');
  });
  $('#filtre-recrutement').on('change', function () {
    $(this).submit();
  });
  $('#filtre-recrutement').on('submit', function (e) {
    e.preventDefault();

    var result = $('#recrutement-result');
    result.html('<p class="w-100 text-center text-primary">Chargement...</p>');

    $.ajax({
      url: ajaxurl,
      method: 'POST',
      data: {
        action: 'load_list_recrutement',
        filter: {
          job: $('[name="job"]').val(),
          shop: $('[name="shop"]').val(),
          city: $('[name="city"]').val(),
        },
      },
    }).done(function (response) {
      result.html('');
      result.append(response);
    });
  });
})(jQuery);
