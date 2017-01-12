CKEDITOR.plugins.add( 'widgetsecon', {
    requires: 'widget',

    icons: 'widgetseconContact',

    init: function( editor ) {
         // Configurable settings
        var allowedFull = editor.configwidgetsecon_allowedFull != undefined ? editor.config.widgetsecon_allowedFull :
            'div(!row,two-col-left,two-col-right,accordion,two-col,three-col){width};' +
            'div(!columns,col-xs-12,col-sm-3,col-sm-9,col-sidebar,col-main,col-1,col-2,col-3,panel,panel-default,panel-heading,panel-body)';
        var allowedWidget = editor.config.widgetsecon_allowedWidget != undefined ? editor.config.widgetsecon_allowedFull :
            'p br ul ol li a strong em img[!src,alt,width,height]';
        var allowedText = editor.config.widgetsecon_allowedText != undefined ? editor.config.widgetsecon_allowedFull :
            'p br ul ol li strong em';
        var allowedTitle = editor.config.widgetsecon_allowedTitle != undefined ? editor.config.widgetsecon_allowedTitle :
            'strong em';
   

         editor.widgets.add( 'widgetseconContact', {
            button: 'Insert contact', 
            template:
                '<div class="panel panel-default">' +
                    '<div class="panel-heading box-title">Title</h2></div>' +
                    '<div class="panel-body box-content">Content</div>' +
                '</div>',

            editables: {
                title: {
                    selector: '.common-table__cell',
                    allowedContent: allowedTitle
                }
            },

            allowedContent: allowedFull,

            upcast: function( element ) {
                return element.name == 'table' && element.hasClass( 'contacts__table' );
            }

        } );

 
        // Append the widget's styles when in the CKEditor edit page,
        // added for better user experience.
        // Assign or append the widget's styles depending on the existing setup.
        if (typeof editor.config.contentsCss == 'object') {
            editor.config.contentsCss.push(CKEDITOR.getUrl(this.path + 'contents.css'));
        }

        else {
            editor.config.contentsCss = [editor.config.contentsCss, CKEDITOR.getUrl(this.path + 'contents.css')];
        }
                         alert("5");
    }


} );