
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

