(function ($) {
	 $(function(){
        function load_admission() {
            var base = $('a[data-type="base"].current').attr("data-id"); 
            var form = $('a[data-type="form"].current').attr("data-id"); 
            var type = $('a[data-type="type"].current').attr("data-id"); 
            $.get(Drupal.settings.basePath + 'admission/result', { base: base, form: form, type: type }, function(html) {
                   $(".adm-results").html(html);
            })  
        }
        $('.adm-controls').click(function() {
          var group = $(this).attr("data-type"); 
          $('a[data-type="'+group+'"]').removeClass('current'); 
          $(this).addClass('current');  
          load_admission() ;         
        })
        load_admission();
        $(".adm-reset").click(function() {
            $('.adm-controls').removeClass("current"); 
            load_admission() ; 

        })
	 })
})(jQuery);
