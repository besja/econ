$fullMenu = $("#full-menu");
// показываем-скрываем развернутое меню
$('#main-menu li').click(function (e) {
  e.preventDefault();
  if($(this).hasClass("active")){
    setTimeout(function(){
      $('#main-menu li').removeClass("active");
    },100);
    $fullMenu.removeClass("full-menu--open");
  } else {
    $fullMenu.addClass("full-menu--open");
    closeFullMenu();
  }
});


function closeFullMenu() {
  $(document).mouseup(function (e){
      var container = $("#full-menu");
      if (!container.is(e.target) && container.has(e.target).length === 0)
      {
          container.removeClass("full-menu--open");
          $("#main-menu li").removeClass("active");
          setTimeout(function () {
            $(document).unbind("mouseup");
          },100)
      }
  });
}


// $('#main-menu li:first-child').click()

$("#mobile-menu-button").click(function () {
  $("html").addClass("disable-scroll mobile-menu--open");
  $('#mobile-menu').perfectScrollbar({maxScrollbarLength : 80 }).perfectScrollbar('update');
})
$("#aside-menu-shade, #mobile-menu__close").click(function () {
  $("html").removeClass("disable-scroll mobile-menu--open");
})
