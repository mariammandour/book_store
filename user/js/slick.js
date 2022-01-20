$(document).ready( function (){
$('.regular').slick({
  arrows: false,
  infinite: true,
  speed: 300,
  slidesToShow: 3,
  slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        infinite: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        infinite: true
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});
  // slide
  $('.prev').click(function(){
    $('.slider').slick('slickPrev');
  })
  
  $('.next').click(function(){
    $('.slider').slick('slickNext');
  })
  setInterval(function(){
    $('.slider').slick('slickNext');
    },5000);
});