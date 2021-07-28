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

  var inputFile = $('.elementor-upload-field');
  $.each(inputFile, function () {
    var label = $(this).siblings();
    var defaultLabel = label.text();

    $(this).on('change', function (e) {
      if (this.files && this.files.length) {
        label.text(this.files[0].name);
      } else {
        label.text(defaultLabel);
      }
    });
  });
})(jQuery);
