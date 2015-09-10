$(document).ready(function () {
  if ( $( ".page" ).length && md.matches ) {
    $("aside").stick_in_parent({parent: ".page"})
      .on("sticky_kit:bottom", function(e) {
        $(e.target).parent().css("position","initial");
    });
  }
  $(window).resize(function () {
    if (md.matches) {
       $("aside").stick_in_parent({parent: ".page"})
      .on("sticky_kit:bottom", function(e) {
        $(e.target).parent().css("position","initial");
    });
    } else {
      $("aside").trigger("sticky_kit:detach");
    }
  })
})

