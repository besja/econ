$(document).ready(function(){

    if($("#notice-widget__slider").length){
        $("#notice-widget__slider").owlCarousel({
            items : 1,
            itemsDesktop: [1600,1],
            itemsTablet: [768,3],
            itemsScaleUp : true,
            autoPlay : false,
            autoHeight : true
        });
        var noticeWidgetSlider = $("#notice-widget__slider").data('owlCarousel');
    }

    if($(".common-slider__slides").length){
        owl = $(".common-slider__slides");
        function fillMeta () {
          currentSlider = $(this.owl.baseElement);
          metaHolder = $(currentSlider).next(".common-slider__meta");
          slides = currentSlider.find(".slide-meta");
          currentTitle = $(slides[this.owl.currentItem]).find(".slide-meta__title").text();
          currentAuthor = $(slides[this.owl.currentItem]).find(".slide-meta__name").text()
          metaHolder.find(".common-slider__title").text(currentTitle);
          metaHolder.find(".common-slider__author__name").text(currentAuthor);
          metaHolder.find(".common-slider__current-number").text(this.owl.currentItem  + 1);
        }
        owl.owlCarousel({
          items : 1,
          singleItem : true,
          itemsScaleUp : true,
          // autoPlay : true,
          autoHeight : true,
          navigationText : false,
          pagination : false,
          afterInit : function(){
            currentSlider = $(this.owl.baseElement);
            currentSlider.next().find(".common-slider__total-slides").text(this.owl.owlItems.length);
            currentSlider.siblings(".common-slider__control").prependTo(currentSlider);
          },
          afterAction : fillMeta
        });
        $(".common-slider__control--next").click(function(){$(this).parent().trigger('owl.next');})
        $(".common-slider__control--prev").click(function(){$(this).parent().trigger('owl.prev');})
    }



    if($(".articles-filter").length){
        $articlesFilter = $(".articles-filter")
        function changePos () {
           if (!md.matches){
            $articlesFilter.insertAfter($(".spotlight"));
          } else {
            $articlesFilter.prependTo($("aside"));
          }
        }
        $(window)
    //       .scroll(function () {articlesFilterFixed();})
          .resize(function () {
            changePos();
            // articlesFilterFixed();
          })
          changePos();

    }
});

