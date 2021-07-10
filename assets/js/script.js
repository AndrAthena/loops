(function ($) {
  var search = $('.search-header');
  var btn = $('.search-header button');
  var form = $('.search-header .search-form');
  btn.click(function () {
    search.toggleClass('active');
    form.find('input').focus();
  });

  var prev = `
    <button class="btn rounded-0 bg-white">
      <svg width="16" height="16" viewBox="0 0 16 23" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M12.0301 23L16 19.1859L7.93985 11.5578L16 3.81407L12.0301 -3.47062e-07L1.00031e-06 11.5578L12.0301 23Z" fill="#020203"/>
      </svg>
    </button>
  `;

  var next = `
    <button class="btn rounded-0 bg-white">
      <svg width="16" height="16" viewBox="0 0 16 23" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M3.96992 0L0 3.81407L8.06015 11.4422L0 19.1859L3.96992 23L16 11.4422L3.96992 0Z" fill="#020203"/>
      </svg>
    </button>
  `;

  $('.agenda-list').slick({
    slidesToShow: 3,
    slidesToScroll: 3,
    swipeToSlide: 3,
    arrows: true,
    infinite: false,
    prevArrow: prev,
    nextArrow: next,
  });

  $('.project-list').slick({
    slidesToShow: 3,
    slidesToScroll: 3,
    swipeToSlide: 3,
    arrows: true,
    centerMode: true,
    centerPadding: '0',
    initialSlide: 1,
    appendArrows: '.navigation',
    prevArrow: prev,
    nextArrow: next,
  });
})(jQuery);
