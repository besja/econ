CKEDITOR.plugins.add( 'widgetcommon', {
    requires: 'widget',

    icons: 'widgetcommonContactTwoColumns,widgetcommonContactThreeColumns,widgetcommonContactFourColumns,widgetcommonPerson,widgetcommonQuotebox,widgetcommonBox',

    defaults : {
        name: 'accordion',
        count: 3,
        activePanel: 1,
        multiExpand: false
    },

    init: function( editor ) {

        // Configurable settings
        var allowedFull = 'div(!contact,contacts__name,contacts__job,common-module,common-table__cell);';

        var allowedWidget = editor.config.widgetcommon_allowedWidget != undefined ? editor.config.widgetcommon_allowedFull :
            'p br ul ol li a strong em img[!src,alt,width,height]';


        var allowedText = 'a[*];br;em;strong;b';


        var allowedTitle = editor.config.widgetcommon_allowedTitle != undefined ? editor.config.widgetcommon_allowedTitle :
            'strong em';

        //allowedWidget = 'img[!src,alt,width,height]';
        //allowedText = allowedWidget;

        var showButtons = editor.config.widgetcommonShowButtons != undefined ? editor.config.widgetcommonShowButtons : true;
        editor.widgets.add( 'widgetcommonContactTwoColumns', {
            button: showButtons ? 'Add Two Columns Contact' : undefined,
            template:
                '<div class="contact ContactTwoColumns">'+
                    '<div class="contacts__name">Фамилия Имя Отчество</div>'+
                    '<div class="contacts__job">Должность или подзаголовок</div>'+
                   ' <table class="common-module common-table contacts__table">'+
                       ' <tbody>'+
                            '<tr class="common-table__row">'+
                              '  <td class="common-table__cell"><div class="cell__header common-table__cell--header">Телефон</div><div class="cell__content common-table__cell--content"><a href="tel:+7812111111">+7 812 111 11 11</a></div></td>'+
                           '     <td class="common-table__cell"><div class="cell__header common-table__cell--header">E-mail</div><div class="cell__content common-table__cell--content"><a href="mailto:mail@example.org">mail@example.org</a></div></td>'+
                      '      </tr>'+
                     '   </tbody>'+
                   ' </table>'+
                '</div>',  
            editables: {
                contacts__name: {
                    selector: '.ContactTwoColumns .contacts__name',
                    allowedContent: allowedText
                },
                contacts__job: {
                    selector: '.ContactTwoColumns .contacts__job',
                    allowedContent: allowedText
                },
                cell1__header: {
                    selector: '.ContactTwoColumns td:nth-child(1) .cell__header',
                    allowedContent: allowedText
                },
                cell1__content: {
                    selector: '.ContactTwoColumns td:nth-child(1) .cell__content',
                    allowedContent: allowedText
                },
                cell2__header: {
                    selector: '.ContactTwoColumns td:nth-child(2) .cell__header',
                    allowedContent: allowedText
                },
                cell2__content: {
                    selector: '.ContactTwoColumns td:nth-child(2) .cell__content',
                    allowedContent: allowedText
                },
            }, 
            allowedContent: allowedFull, 

            upcast: function( element ) {
                return element.name == 'div' && element.hasClass( '.ContactTwoColumns.contact' );
            }        
        }); 
       editor.widgets.add( 'widgetcommonContactThreeColumns', {
            button: showButtons ? 'Add Three Columns Contact' : undefined,
            template:
                '<div class="contact ContactThreeColumns">'+
                    '<div class="contacts__name">Фамилия Имя Отчество</div>'+
                    '<div class="contacts__job">Должность или подзаголовок</div>'+
                   ' <table class="common-module common-table contacts__table">'+
                       ' <tbody>'+
                            '<tr class="common-table__row">'+
                              '  <td class="common-table__cell"><div class="cell__header common-table__cell--header">Телефон</div><div class="cell__content common-table__cell--content"><a href="tel:+7812111111">+7 812 111 11 11</a></div></td>'+
                           '     <td class="common-table__cell"><div class="cell__header common-table__cell--header">E-mail</div><div class="cell__content common-table__cell--content"><a href="mailto:mail@example.org">mail@example.org</a></div></td>'+
                                '<td class="common-table__cell"><div class="cell__header common-table__cell--header">Адрес</div><div class="cell__content common-table__cell--content">191123, Санкт-Петербург, ул. Чайковского, 62, ауд. № 311</div></td>'+
                      '      </tr>'+
                     '   </tbody>'+
                   ' </table>'+
                '</div>',  
            editables: {
                contacts__name: {
                    selector: '.ContactThreeColumns .contacts__name',
                    allowedContent: allowedText
                },
                contacts__job: {
                    selector: '.ContactThreeColumns .contacts__job',
                    allowedContent: allowedText
                },
                cell1__header: {
                    selector: '.ContactThreeColumns td:nth-child(1) .cell__header',
                    allowedContent: allowedText
                },
                cell1__content: {
                    selector: '.ContactThreeColumns td:nth-child(1) .cell__content',
                    allowedContent: allowedText
                },
                cell2__header: {
                    selector: '.ContactThreeColumns td:nth-child(2) .cell__header',
                    allowedContent: allowedText
                },
                cell2__content: {
                    selector: '.ContactThreeColumns td:nth-child(2) .cell__content',
                    allowedContent: allowedText
                },
                cell3__header: {
                    selector: '.ContactThreeColumns td:nth-child(3) .cell__header',
                    allowedContent: allowedText
                },
                cell3__content: {
                    selector: '.ContactThreeColumns td:nth-child(3) .cell__content',
                    allowedContent: allowedText
                },
            }, 
            allowedContent: allowedFull, 

            upcast: function( element ) {
                return element.name == 'div' && element.hasClass( '.ContactThreeColumns.contact' );
            }        
        }); 
       editor.widgets.add( 'widgetcommonContactFourColumns', {
            button: showButtons ? 'Add Four Columns Contact' : undefined,
            template:
                '<div class="contact ContactFourColumns">'+
                    '<div class="contacts__name">Фамилия Имя Отчество</div>'+
                    '<div class="contacts__job">Должность или подзаголовок</div>'+
                   ' <table class="common-module common-table contacts__table">'+
                       ' <tbody>'+
                            '<tr class="common-table__row">'+
                              '  <td class="common-table__cell"><div class="cell__header common-table__cell--header">Телефон</div><div class="cell__content common-table__cell--content"><a href="tel:+7812111111">+7 812 111 11 11</a></div></td>'+
                           '     <td class="common-table__cell"><div class="cell__header common-table__cell--header">E-mail</div><div class="cell__content common-table__cell--content"><a href="mailto:mail@example.org">mail@example.org</a></div></td>'+
                                '<td class="common-table__cell"><div class="cell__header common-table__cell--header">Адрес</div><div class="cell__content common-table__cell--content">191123, Санкт-Петербург, ул. Чайковского, 62, ауд. № 311</div></td>'+
                                '<td class="common-table__cell"><div class="cell__header common-table__cell--header">Приемные часы</div><div class="cell__content common-table__cell--content">Пн, Вт, Ср, Чт, Пт<br>10.00–18.00</div></td>'+
                      '      </tr>'+
                     '   </tbody>'+
                   ' </table>'+
                '</div>',  
            editables: {
                contacts__name: {
                    selector: '.ContactFourColumns .contacts__name',
                    allowedContent: allowedText
                },
                contacts__job: {
                    selector: '.ContactFourColumns .contacts__job',
                    allowedContent: allowedText
                },
                cell1__header: {
                    selector: '.ContactFourColumns td:nth-child(1) .cell__header',
                    allowedContent: allowedText
                },
                cell1__content: {
                    selector: '.ContactFourColumns td:nth-child(1) .cell__content',
                    allowedContent: allowedText
                },
                cell2__header: {
                    selector: '.ContactFourColumns td:nth-child(2) .cell__header',
                    allowedContent: allowedText
                },
                cell2__content: {
                    selector: '.ContactFourColumns td:nth-child(2) .cell__content',
                    allowedContent: allowedText
                },
                cell3__header: {
                    selector: '.ContactFourColumns td:nth-child(3) .cell__header',
                    allowedContent: allowedText
                },
                cell3__content: {
                    selector: '.ContactFourColumns td:nth-child(3) .cell__content',
                    allowedContent: allowedText
                },
                cell4__header: {
                    selector: '.ContactFourColumns td:nth-child(4) .cell__header',
                    allowedContent: allowedText
                },
                cell4__content: {
                    selector: '.ContactFourColumns td:nth-child(4) .cell__content',
                    allowedContent: allowedText
                },
            }, 
            allowedContent: allowedFull, 

            upcast: function( element ) {
                return element.name == 'div' && element.hasClass( '.ContactFourColumns.contact' );
            }        
        }); 
       editor.widgets.add( 'widgetcommonPerson', {
            button: showButtons ? 'Add Person' : undefined,
            template:
                '<div class="common-module person-card">'+
                '    <div class="row">'+
                '        <div class="col-xs-6 col-sm-4 person-card__image"><img alt="" src="http://new.econ.spbu.ru/sites/all/themes/econ/spbgu/app/img/temp/person-card.jpg"></div>'+        
                '             <div class="col-xs-12 col-sm-8">'+
                '            <h3 class="person-card__name">Александр Алексеевич Вознесенский</h3>'+
                '            <div class="person-card__years">1898–1950</div>'+
                '            <div class="person-card__lead">Кандидат экономических наук, профессор. Должность декана экономического факультета занимал в 1940—1941 гг.</div>'+
                '        </div>'+
                '    </div>'+
                '    <div class="person-card__text">Несмотря на то, что преподавание экономической теории и статистики началось в Санкт-Петербургском университете в 1819 г., экономический факультет был создан только с 1 сентября 1940 г. Приказом ректора университета № 80 от 23.06.40 г. Его основание как самостоятельного подразделения Ленинградского университета связано с именем профессора А.А.Вознесенского, ставшего его первым деканом.</div>'+
                '</div>',

            editables: {
                image: {
                    selector: '.person-card .person-card__image',
                    allowedContent: ""
                },
                name: {
                    selector: '.person-card .person-card__name',
                    allowedContent: ""
                },
                years: {
                    selector: '.person-card .person-card__years',
                    allowedContent: ""
                },
                lead: {
                    selector: '.person-card .person-card__lead',
                    allowedContent: allowedText
                },
                text: {
                    selector: '.person-card .person-card__text',
                    allowedContent: 'a[*];br;em;strong;b;p'
                },
 
            }, 
            allowedContent: allowedFull, 

            upcast: function( element ) {
                return element.name == 'div' && element.hasClass( '.common-module.person-card' );
            }        
        }); 
        editor.widgets.add( 'widgetcommonBox', {

            button: showButtons ? 'Add box' : undefined,
            template:
                '<div class="contact">'+
                    '<div class="contacts__name">Александра Николаевна Соболева</div>'+
                    '<div class="contacts__job">Профессор, заведующий кафедрой, доктор экономических наук</div>'+
                   ' <table class="common-module common-table contacts__table">'+
                       ' <tbody>'+
                            '<tr class="common-table__row">'+
                              '  <td class="common-table__cell"><div class="cell__header common-table__cell--header">АДРЕС КАФЕДРЫ</div><div class="cell__content common-table__cell--content">191123, Санкт-Петербург</div></td>'+
                           '     <td class="common-table__cell"><div class="cell__header common-table__cell--header">ПРИЕМНЫЕ ЧАСЫ</div><div class="cell__content common-table__cell--content">Пн, Вт, Ср, Чт, Пт</div></td>'+
                                '<td class="common-table__cell"><div class="cell__header common-table__cell--header">Телефон, факс</div><div class="cell__content common-table__cell--content"><a href="tel:+78122720330">+7 812 272 03 30</a></div></td>'+
                            '    <td class="common-table__cell"><div class="cell__header common-table__cell--header">E-MAIL, WEB</div><div class="cell__content common-table__cell--content"><a href="mailto:worldec@econ.pu.ru">worldec@econ.pu.ru</a></div></td>'+
                      '      </tr>'+
                     '   </tbody>'+
                   ' </table>'+
                '</div>',

            editables: {
                contacts__name: {
                    selector: '.contacts__name',
                    allowedContent: allowedText
                },
                contacts__job: {
                    selector: '.contacts__job',
                    allowedContent: allowedText
                },
                cell__header: {
                    selector: '.cell__header',
                    allowedContent: allowedText
                },
                cell__content: {
                    selector: '.cell__content',
                    allowedContent: allowedText
                },
            },

            allowedContent: allowedFull, 

            upcast: function( element ) {
                return element.name == 'div' && element.hasClass( 'contact' );
            }

        } );

        // Define the widgets
        editor.widgets.add( 'widgetcommonQuotebox', {

            button: showButtons ? 'Add Quotebox' : undefined,

            template:
                '<div class="row quotebox">' +
                    '<div class="row quote">Quote</div>' +
                    '<div class="row byline">&mdash; Person</div>' +
                '</div>',

            editables: {
                quote: {
                    selector: '.quote',
                    allowedContent: allowedFull
                },
                byline: {
                    selector: '.byline',
                    allowedContent: allowedTitle
                }
            },

            allowedContent: allowedFull,

            upcast: function( element ) {
                return element.name == 'div' && element.hasClass( 'quotebox' );
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
    }


} );