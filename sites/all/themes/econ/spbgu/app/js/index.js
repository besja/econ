$(document).ready(function(){
    if($("#index-page").length){


    $("#intro__slider").owlCarousel({
        singleItem : true,
        itemsScaleUp : true,
        slideSpeed : 200,
        paginationSpeed : 800,
        rewindSpeed : 1000,
        autoPlay : true,
        stopOnHover : true,
        autoHeight : true
    });   

    // Расчитываем высоту блоков на главной
    function indexHeights() {
        $('#news-widget__inner')
            .perfectScrollbar({
                maxScrollbarLength : 60,
                suppressScrollX : true
            })
            .perfectScrollbar('update');
        if (md.matches) {
            indexHeight = $("#events-widget").height();
            newsWidgetMargin = $("#notice-widget").height() + $("#news-widget__btn").height()
            newsWidgetHeight = indexHeight - newsWidgetMargin;
            $("#intro").height(indexHeight);
            $("#news-widget__inner").height(newsWidgetHeight).perfectScrollbar('update');
        } else{
            $("#intro, #news-widget__inner").height("100%");
        }
    }

    $(window).resize(function() {
        indexHeights()
        setTimeout(function(){indexHeights()},300)
    });

    indexHeights();
    setTimeout(function(){
        indexHeights();
        $('#intro').perfectScrollbar({
            wheelPropagation: true,
            maxScrollbarLength : 80,
            suppressScrollX : true
        });
        $('#news-widget__inner').perfectScrollbar('update');
    },300);
    }
    if($("#notice-widget__slider").length){
        $("#notice-widget__slider").owlCarousel({
            items : 1,
            itemsDesktop: [1600,1],
            itemsTablet: [768,3],
            itemsScaleUp : true,
            autoPlay : false,
            autoHeight : true, 
            afterAction: function() {
              indexHeights();
            }
        });
        var noticeWidgetSlider = $("#notice-widget__slider").data('owlCarousel');
    } 
});

