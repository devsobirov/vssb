$(document).ready(function(){
  $(".loader").remove()
  $width = $(window).width()
$(window).resize(function(){
    $width = $(window).width()  
})
$(".main-menu>li>ul").parent().click(function(){
    if($width<961){
        $(this).find("ul").toggle(100)
    $(this).find(">a>i").toggleClass("fi-angle-up")
    }
})
$(".main-menu>li>ul").parent().find(">a").append("<i class='fi fi-angle-down'></i>")

$('.links').slick({
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    arrows:false,
    responsive: [
        {
          breakpoint: 960,
          settings: {
            arrows: false,
            centerMode: true,
            centerPadding: '10px',
            slidesToShow: 2
          }
        },
        {
          breakpoint: 480,
          settings: {
            arrows: false,
            centerMode: true,
            centerPadding: '40px',
            slidesToShow: 1
          }
        }
      ]
  });
  $(window).scroll(function(){
    if($(this).scrollTop()>350){
        $(".up").show(300)
    } else {
        $(".up").hide(300)
    }
  })
  $("[to]").click(function(){
    $(this).find(">i").toggleClass("fi-angle-up")
    $id = $(this).attr("to")
    $("#"+$id).toggle(200)
  })
})