jQuery(document).ready(function($) {

  const SEARCH_DELAY = 100; // in ms
  const interval = setInterval(() => {
    if ($('.ive-product-slider-hidden').length > 0) {
      $(".ive-product-slider-hidden").each(function(i, el) {
        $(el).removeClass('ive-product-slider-hidden');

        var navtextprev = $(this).attr('data-navtextprev');
        var navtextnext = $(this).attr('data-navtextnext');
        var navbtntype = $(this).attr('data-navbtntype');

        if (navbtntype=='icon') {
          // Sanitize icon class names to prevent XSS
          var sanitizedPrevIcon = navtextprev.replace(/<[^>]*>/g, '').replace(/on[a-z]+=("|').*?\1/gi, '');
          var sanitizedNextIcon = navtextnext.replace(/<[^>]*>/g, '').replace(/on[a-z]+=("|').*?\1/gi, '');
          var navtextprevicon= `<i class="`+sanitizedPrevIcon+`"></i>`;
          var navtextnexticon= `<i class="`+ sanitizedNextIcon +`"></i>`;
        }else{
          // For text navigation, use safe text content
          var navtextprevicon= navtextprev.replace(/<[^>]*>/g, '').replace(/on[a-z]+=("|').*?\1/gi, '');
          var navtextnexticon = navtextnext.replace(/<[^>]*>/g, '').replace(/on[a-z]+=("|').*?\1/gi, '');
        }

        var settingData = {
          nav: true,
          dots: true,
          margin: parseInt($(this).attr('data-margin')),
          stagePadding: parseInt($(this).attr('data-stagepadding')),
          rewind: ($(this).attr('data-rewind') === "true"),
          autoplay: ($(this).attr('data-autoplay') === "true"),
          autoplayTimeout: parseInt($(this).attr('data-autoplaytimeout')),
          autoplayHoverPause: ($(this).attr('data-autoplayhoverpause') === "true"),
          autoplaySpeed: parseInt($(this).attr('data-autoplayspeed')),
          navSpeed: parseInt($(this).attr('data-navspeed')),
          dotsSpeed: parseInt($(this).attr('data-dotsspeed')),
          loop: ($(this).attr('data-loop') === "true"),
          navText: [navtextprevicon, navtextnexticon],
          responsive: {
            0: {
              items: 1
            },
            425: {
              items: parseInt($(this).attr('data-responsive-mob'))
            },
            720: {
              items: parseInt($(this).attr('data-responsive-tab'))
            },
            1024: {
              items: parseInt($(this).attr('data-responsive-desk'))
            }
          }
        };
        $(this).owlCarousel(settingData);
      });
    }
  }, SEARCH_DELAY);

});
