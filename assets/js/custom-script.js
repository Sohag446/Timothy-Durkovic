
// header
jQuery(window).on('scroll', function() {
    if (jQuery(this).scrollTop() > 50) { 
      jQuery('header').addClass('scroll-top');
    } else {
      jQuery('header').removeClass('scroll-top');
    }
});


jQuery(document).ready(function($) {

    // Review Slider
    if ($('.people_saying_message_body').length) {
      $('.people_saying_message_body').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: false,
        arrows: true,
        autoplay: false,
        infinite: true,
        responsive: [
          {
            breakpoint: 1100,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 1,
            }
          },
          {
            breakpoint: 998,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
            }
          }
        ]
      });
    }


    //recognition slider
    if ($('.recognition-slider').length) {
      $('.recognition-slider').slick({
        slidesToShow: 2,
        rows: 4,
        slidesToScroll: 1,
        dots: false,
        arrows: true,
        autoplay: true,
        infinite: true,
        prevArrow:'<button type="button" class="slick-prev rec-arrow-left rec-arrow"><img src="/wp-content/themes/timothy_durkovic/assets/img/white-left-arrow.png" ></button>',
        nextArrow:'<button type="button" class="slick-next rec-arrow-right rec-arrow"><img src="/wp-content/themes/timothy_durkovic/assets/img/white-right-arrow.png" ></button>',
        responsive: [
          {
            breakpoint: 1100,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 1,
              rows: 4,
            }
          },
          {
            breakpoint: 999,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
              rows: 2,
            }
          },
          {
            breakpoint: 767,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
              rows: 3,
            }
          }
        ]
      });
    }



  // Calender Tab
  $('.sgl-cat').on('click', function(){
    var id = $(this).attr('id');
    id = id.split('-');
    $('.all-tab-cat .sgl-cat').not($(this)).removeClass('active');
    $(this).addClass('active');
    $('.all-events .single-event:not(.sgl-cat-'+id[1]+')').hide();
    $('.all-events .sgl-cat-'+id[1]).show();
  });






}); //ready function

