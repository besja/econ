$(window).scroll(function () {
    currentBottom = $(window).scrollTop() + $(window).height();
    footerOffset = $(".footer").offset()
    // console.log(currentBottom + " " + footerOffset.top);
    if (currentBottom > footerOffset.top) {
        $(".spbgu-portal").addClass("visible");
    } else {
        $(".spbgu-portal").removeClass("visible open");
    }
})
$(".spbgu-portal__label").click(function () {
  $(this).parent().toggleClass("open");
  if($(this).parent().hasClass("open")){
    $('body').on({'touchmove': function(e) {e.preventDefault();}});
    $('#spbgu-portal__accordion').perfectScrollbar({wheelPropagation: true, maxScrollbarLength : 60}).perfectScrollbar('update');
  } else{
    $('body').unbind("touchmove");
  }
})
$(".spbgu-portal__header").click(function () {
    setTimeout(function(){
        $('#spbgu-portal__accordion, .spbgu-portal__list').perfectScrollbar({wheelPropagation: true, maxScrollbarLength : 60}).perfectScrollbar('update');
    },300)
})
