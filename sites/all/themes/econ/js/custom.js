

(function ($) {
	 $(function(){
	 	
	 	var i = 0;
	 	var arrow = '<svg width="35" height="35" viewBox="0 0 35 35" xmlns="http://www.w3.org/2000/svg"><title>left</title><g transform="matrix(-1 0 0 1 33 2)" stroke="#FFF" stroke-width="3" fill="none" fill-rule="evenodd"><path d="M11.558 7.545l6.937 6.937c.783.783.787 2.047 0 2.834l-6.608 6.61"/><ellipse cx="15.735" cy="15.735" rx="15.735" ry="15.735"/></g></svg>'; 
       	var arrow_left = '<div class="common-slider__control common-slider__control--next"><i>'+arrow+'</i></div>'; 
       	var arrow_right = '<div class="common-slider__control common-slider__control--prev"><i>'+arrow+'</i></div>';
       	$(".content .gallery").each(function() {
       
       		var html = '<div class="common-module common-slider">'+arrow_left + arrow_right+'<div id="slider-'+i+'" class="common-slider__slides owl-carousel">'; 
            
       		$(this).find("img").each(function() {
       			var title = ''; 
       			if ($(this).attr('title')) {
       				title = $(this).attr('title'); 
       			}

       			var alt = ''; 
       			if ($(this).attr('alt')) {
       				alt = $(this).attr('alt'); 
       			}

       			html += '<div><img src="'+$(this).attr('src')+'" alt="'+$(this).attr('alt')+'"/><div class="slide-meta"><div class="slide-meta__title">'+title+'</div><div class="slide-meta__name" >'+alt+'</div></div></div>'; 
       		}); 
       		html += '</div><div class="row common-slider__meta"><div class="col-xs-9 col-sm-10"><div class="common-slider__title"></div><div class="common-slider__author"><span  class="common-slider__author__name" ></span></div></div> <div class="col-xs-3 col-sm-2"><div class="common-slider__counter"><span class="common-slider__current-number"></span> / <span class="common-slider__total-slides"></span></div></div></div></div>';
       		$(this).replaceWith(html);
       		i++;
       	})  

              if ($('#common-search').length) {
                     var region = $("#common-search").find("input[name='region']").val();
                     $(".search-tabs a").removeClass("current");
                     $(".search-tabs a[data-id = '"+region+"']").addClass("current");
                     //alert(region);
                     $(".search-tabs a").click(function() {
                            $(".search-tabs a").removeClass("current");
                            $(this).addClass("current"); 
                            $("#common-search").find("input[name='region']").val($(this).attr("data-id"));
                     })
              } 
              if ($("#contact-site-form").length) {
                     $('#contact-site-form .form-type-textfield label').each(function() {
                            $(this).find('span').replaceWith('');
                            var txt = $(this).text();
                            $(this).siblings('input').attr('placeholder', txt);
                            $(this).hide();
                           // alert(txt);
                     })
              }

              $('.contacts__table').each(function() {
                     var total = $(this).find("tr:first td").length;
                     $('.contacts__table').addClass('table-width-'+total);
              }) 
              $('.common-table--person').each(function() {
                     //var total = $(this).find("tr td").length;
                     var total = $(this).find("tr:first td").length;
                     $('.common-table--person').addClass('table-width-'+total);
              }) 
	 })
})(jQuery);
