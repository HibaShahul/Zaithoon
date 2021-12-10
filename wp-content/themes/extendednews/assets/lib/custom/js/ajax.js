
jQuery(document).ready(function ($) {
    "use strict";

    var ajaxurl = extendednews_ajax.ajax_url;

    // Tab Posts ajax Load
    $('.tab-posts a').click( function(){

        var category = $(this).attr('cat-data');
        var sectionid = $(this).closest('.theme-block-navtabs').attr('id');
        var curentelement = $('#'+sectionid+' .tab-content-'+category);
        $('#'+sectionid+' .tab-posts a').removeClass( 'active-tab' );
        $(this).addClass('active-tab');
        $(this).closest('.theme-block-navtabs').find('.tab-contents').removeClass('content-active');
        $( curentelement ).addClass( 'content-active' );
        var currencBlock = $( curentelement ).closest('.theme-block-navtabs').attr('repeat-time');

        if( !$( curentelement ).hasClass( 'content-loaded' ) ){

            $( curentelement ).addClass( 'content-loading' );

            var data = {
                'action': 'extendednews_tab_posts_callback',
                'category': category,
                'currencBlock': currencBlock,
                '_wpnonce': extendednews_ajax.ajax_nonce,
            };

            $.post(ajaxurl, data, function( response ) {

                $( curentelement ).first().html( response );

                if( !$( curentelement ).closest('.theme-block-navtabs').find('tab-contents').hasClass('content-loaded') ){

                    $('.'+currencBlock + '-content-active').each(function(){

                        $(this).removeClass(currencBlock + '-content-active');

                    });

                }

                $( curentelement ).removeClass( 'content-loading' );
                $( curentelement ).addClass( 'content-loaded' );
                $( curentelement ).find( '.content-loading-status' ).remove();

                var pageSection = $(".data-bg");
                pageSection.each(function (indx) {

                    if ($(this).attr("data-background")) {

                        $(this).css("background-image", "url(" + $(this).data("background") + ")");

                    }

                });
    
            });

        }

    });
    
});