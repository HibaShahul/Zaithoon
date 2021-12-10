// Vimeo Vieo Function
ExtendedNews_Vimeo();
function ExtendedNews_Vimeo(){

    /*! vimeo-jquery-api 2016-05-05 */
    !function(a,b){var c={catchMethods:{methodreturn:[],count:0},init:function(b){;var c,d,e;b.originalEvent.origin.match(/vimeo/gi)&&"data"in b.originalEvent&&(e="string"===a.type(b.originalEvent.data)?a.parseJSON(b.originalEvent.data):b.originalEvent.data,e&&(c=this.setPlayerID(e),c.length&&(d=this.setVimeoAPIurl(c),e.hasOwnProperty("event")&&this.handleEvent(e,c,d),e.hasOwnProperty("method")&&this.handleMethod(e,c,d))))},setPlayerID:function(b){return a("iframe[src*="+b.player_id+"]")},setVimeoAPIurl:function(a){return"http"!==a.attr("src").substr(0,4)?"https:"+a.attr("src").split("?")[0]:a.attr("src").split("?")[0]},handleMethod:function(a){this.catchMethods.methodreturn.push(a.value)},handleEvent:function(b,c,d){switch(b.event.toLowerCase()){case"ready":for(var e in a._data(c[0],"events"))e.match(/loadProgress|playProgress|play|pause|finish|seek|cuechange/)&&c[0].contentWindow.postMessage(JSON.stringify({method:"addEventListener",value:e}),d);if(c.data("vimeoAPICall")){for(var f=c.data("vimeoAPICall"),g=0;g<f.length;g++)c[0].contentWindow.postMessage(JSON.stringify(f[g].message),f[g].api);c.removeData("vimeoAPICall")}c.data("vimeoReady",!0),c.triggerHandler("ready");break;case"seek":c.triggerHandler("seek",[b.data]);break;case"loadprogress":c.triggerHandler("loadProgress",[b.data]);break;case"playprogress":c.triggerHandler("playProgress",[b.data]);break;case"pause":c.triggerHandler("pause");break;case"finish":c.triggerHandler("finish");break;case"play":c.triggerHandler("play");break;case"cuechange":c.triggerHandler("cuechange")}}},d=a.fn.vimeoLoad=function(){var b=a(this).attr("src"),c=!1;if("https:"!==b.substr(0,6)&&(b="http"===b.substr(0,4)?"https"+b.substr(4):"https:"+b,c=!0),null===b.match(/player_id/g)){c=!0;var d=-1===b.indexOf("?")?"?":"&",e=a.param({api:1,player_id:"vvvvimeoVideo-"+Math.floor(1e7*Math.random()+1).toString()});b=b+d+e}return c&&a(this).attr("src",b),this};jQuery(document).ready(function(){a("iframe[src*='vimeo.com']").each(function(){d.call(this)})}),a(["loadProgress","playProgress","play","pause","finish","seek","cuechange"]).each(function(b,d){jQuery.event.special[d]={setup:function(){var b=a(this).attr("src");if(a(this).is("iframe")&&b.match(/vimeo/gi)){var e=a(this);if("undefined"!=typeof e.data("vimeoReady"))e[0].contentWindow.postMessage(JSON.stringify({method:"addEventListener",value:d}),c.setVimeoAPIurl(a(this)));else{var f="undefined"!=typeof e.data("vimeoAPICall")?e.data("vimeoAPICall"):[];f.push({message:d,api:c.setVimeoAPIurl(e)}),e.data("vimeoAPICall",f)}}}}}),a(b).on("message",function(a){c.init(a)}),a.vimeo=function(a,d,e){var f={},g=c.catchMethods.methodreturn.length;if("string"==typeof d&&(f.method=d),void 0!==typeof e&&"function"!=typeof e&&(f.value=e),a.is("iframe")&&f.hasOwnProperty("method"))if(a.data("vimeoReady"))a[0].contentWindow.postMessage(JSON.stringify(f),c.setVimeoAPIurl(a));else{var h=a.data("vimeoAPICall")?a.data("vimeoAPICall"):[];h.push({message:f,api:c.setVimeoAPIurl(a)}),a.data("vimeoAPICall",h)}return"get"!==d.toString().substr(0,3)&&"paused"!==d.toString()||"function"!=typeof e||(!function(a,d,e){var f=b.setInterval(function(){c.catchMethods.methodreturn.length!=a&&(b.clearInterval(f),d(c.catchMethods.methodreturn[e]))},10)}(g,e,c.catchMethods.count),c.catchMethods.count++),a},a.fn.vimeo=function(b,c){return a.vimeo(this,b,c)}}(jQuery,window);

}

// global variable for the action
var action = [];
var iframe = document.getElementsByClassName("video-main-wraper");
var src;
var ratio_class;

ExtendedNews_Video();
ExtendedNews_Video('video-main-wraper-2');
function ExtendedNews_Video( VideoWraperClass = '', youtubeClass = 'twp-iframe-video-youtube' ){

    if( VideoWraperClass ){
        iframe = document.getElementsByClassName(VideoWraperClass);
    }

    Array.prototype.forEach.call(iframe, function(el) {
        // Do stuff here
        var id = el.getAttribute("data-id");
        var autoplay = el.getAttribute("data-autoplay");
        if( autoplay == 'autoplay-enable' ){
            autoplay = 1;
        }else{
            autoplay = 0;
        }
        jQuery(document).ready(function ($) {
            "use strict";

            src = $(el).find('iframe').attr('src');

            if( src ){

                if( src.indexOf('youtube.com') != -1 ){

                    $(el).find('iframe').attr('width','');
                    $(el).find('iframe').attr('height','');
                    $(el).find('iframe').attr('id',id);
                    $(el).find('iframe').addClass(youtubeClass);
                    if( autoplay ){

                        $(el).find('iframe').attr('src',src+'&enablejsapi=1&autoplay=1&mute=1&rel=0&modestbranding=0&autohide=0&showinfo=0&controls=0&loop=1');

                    }else{

                        $(el).find('iframe').attr('src',src+'&enablejsapi=1');

                    }
                    
                    
                }

                if( src.indexOf('vimeo.com') != -1 ){

                    $(el).find('iframe').attr('id',id);
                    $(el).find('iframe').addClass('twp-iframe-video-vimeo');

                    if( autoplay ){

                        $(el).find('iframe').attr('src',src+'&title=0&byline=0&portrait=0&transparent=0&autoplay=1&controls=0&loop=1');

                    }else{

                        $(el).find('iframe').attr('src',src+'&title=0&byline=0&portrait=0&transparent=0&autoplay=0&controls=0&loop=1');

                    }
                    
                    $(el).find('iframe').attr('allow','autoplay;');

                    var player = document.getElementById(id);
                    $(player).vimeo("setVolume", 0);

                    $('#'+id).closest('.entry-video').find('.twp-mute-unmute').on('click',function(){

                        if( $(this).hasClass('unmute') ){

                            $(player).vimeo("setVolume", 1);
                            $(this).removeClass('unmute');
                            $(this).addClass('mute');

                            $(this).find('.twp-video-control-action').empty();
                            $(this).find('.twp-video-control-action').html(extendednews_custom.unmute);
                            $(this).find('.screen-reader-text').html(extendednews_custom.unmute_text);

                        }else if( $(this).hasClass('mute') ){

                            $(player).vimeo("setVolume", 0);
                            $(this).removeClass('mute');
                            $(this).addClass('unmute');
                            $(this).find('.twp-video-control-action').empty();
                            $(this).find('.twp-video-control-action').html(extendednews_custom.mute)

                        }

                    });

                    $('#'+id).closest('.entry-video').find('.twp-pause-play').on('click',function(){

                        if( $(this).hasClass('play') ){

                            $(player).vimeo('play');
                            
                            $(this).removeClass('play');
                            $(this).addClass('pause');
                            $(this).find('.twp-video-control-action').html(extendednews_custom.pause);
                            $(this).find('.screen-reader-text').html(extendednews_custom.pause_text);

                        }else if( $(this).hasClass('pause') ){
                            
                            $(player).vimeo('pause');
                            $(this).removeClass('pause');
                            $(this).addClass('play');
                            $(this).find('.twp-video-control-action').html(extendednews_custom.play);
                            $(this).find('.screen-reader-text').html(extendednews_custom.play_text);

                        }

                    });

                }

            }else{

                var currentVideo;
                
                $(el).find('video').attr('loop','loop');
                $(el).find('video').attr('autoplay','autoplay');
                $(el).find('video').removeAttr('controls');
                $(el).find('video').attr('id',id);

                $('#'+id).closest('.entry-video').find('.twp-mute-unmute').on('click',function(){

                    if( $(this).hasClass('unmute') ){

                        currentVideo = document.getElementById(id);
                        $(currentVideo).prop('muted', false);

                        $(this).removeClass('unmute');
                        $(this).addClass('mute');
                        $(this).find('.twp-video-control-action').html(extendednews_custom.unmute);
                        $(this).find('.screen-reader-text').html(extendednews_custom.unmute_text);

                    }else if( $(this).hasClass('mute') ){

                        currentVideo = document.getElementById(id);
                        $(currentVideo).prop('muted', true);
                        $(this).removeClass('mute');
                        $(this).addClass('unmute');
                        $(this).find('.twp-video-control-action').html(extendednews_custom.mute)

                    }

                });


                if( autoplay ){

                    setTimeout(function(){
                        
                        if( $('#'+id).length ){

                            currentVideo = document.getElementById(id);
                            currentVideo.play();

                        }

                    },3000);

                }

                $('#'+id).closest('.entry-video').find('.twp-pause-play').on('click',function(){

                    if( $(this).hasClass('play') ){

                        currentVideo = document.getElementById(id);
                        currentVideo.play();
                        
                        $(this).removeClass('play');
                        $(this).addClass('pause');
                        $(this).find('.twp-video-control-action').html(extendednews_custom.pause);
                        $(this).find('.screen-reader-text').html(extendednews_custom.pause_text);

                    }else if( $(this).hasClass('pause') ){

                        currentVideo = document.getElementById(id);
                        currentVideo.pause();

                        $(this).removeClass('pause');
                        $(this).addClass('play');
                        $(this).find('.twp-video-control-action').html(extendednews_custom.play);
                        $(this).find('.screen-reader-text').html(extendednews_custom.play_text);

                    }

                });

            }

        });

    });

}

// this function gets called when API is ready to use
function onYouTubePlayerAPIReady() {

    jQuery(document).ready(function ($) {
        "use strict";

        ExtendedNewsYoutubeVideo('.twp-iframe-video-youtube');

    });
}


function ExtendedNewsYoutubeVideo( YTVideoClass = '' ){

    $( YTVideoClass ).each(function(){

        var id = $(this).attr('id');
        
        // create the global action from the specific iframe (#video)
        action[id] = new YT.Player(id, {
            events: {
                // call this function when action is ready to use
                'onReady': function onReady() {

                    var autoplay = $(this).closest('.theme-video-panel').attr('data-autoplay');
                    if( autoplay == 'autoplay-enable' ){
                        action[id].playVideo();
                    }

                    $('#'+id).closest('.entry-video').find('.twp-pause-play').on('click',function(){

                        var id = $(this).attr('attr-id');
                        
                        if( $(this).hasClass('play') ){

                            action[id].playVideo();
                            
                            $(this).removeClass('play');
                            $(this).addClass('pause');
                            $(this).find('.twp-video-control-action').html(extendednews_custom.pause);
                            $(this).find('.screen-reader-text').html(extendednews_custom.pause_text);

                        }else if( $(this).hasClass('pause') ){

                            action[id].pauseVideo();
                            $(this).removeClass('pause');
                            $(this).addClass('play');
                            $(this).find('.twp-video-control-action').html(extendednews_custom.play);
                            $(this).find('.screen-reader-text').html(extendednews_custom.play_text);

                        }
                        

                    });

                    $('#'+id).closest('.entry-video').find('.twp-mute-unmute').on('click',function(){

                        var id = $(this).attr('attr-id');
                        if( $(this).hasClass('unmute') ){

                            action[id].unMute();
                            
                            $(this).removeClass('unmute');
                            $(this).addClass('mute');
                            $(this).find('.twp-video-control-action').html(extendednews_custom.unmute);
                            $(this).find('.screen-reader-text').html(extendednews_custom.unmute_text);

                        }else if( $(this).hasClass('mute') ){

                            action[id].mute();
                            $(this).removeClass('mute');
                            $(this).addClass('unmute');
                            $(this).find('.twp-video-control-action').html(extendednews_custom.mute);
                            $(this).find('.screen-reader-text').html(extendednews_custom.mute_text);

                        }
                        

                    });

                },
            }
        });

    });

}

// Inject YouTube API script
var tag = document.createElement('script');
tag.src = "https://www.youtube.com/player_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);


window.addEventListener("load", function(){
        
    jQuery(document).ready(function($){
        "use strict";

        $("body").addClass("page-loaded");

    });

});

// Responsive Content Render Function
var renderMenu;
var menuContentMain;
function extendednews_responsive_content( renderMenu ){

    jQuery(document).ready(function ($) {
    "use strict";

        if( !menuContentMain ){

            menuContentMain = $('div#site-topbar').html();

        }

        if( $(window).width() <= 991 ){

            var dateContent = $('.top-nav-date').html();

            $('.responsive-content-date').html(dateContent);
            $('div#site-topbar').empty();


        }else{

            $('.responsive-content-date').empty();
            $('.responsive-content-menu').empty();

            if( renderMenu ){
                $('div#site-topbar').html( menuContentMain );
            }

        }

    });

}

jQuery(document).ready(function ($) {
    "use strict";

    // Responsive Content
    extendednews_responsive_content(  renderMenu = false );

    $(window).resize(function(){

        extendednews_responsive_content( renderMenu = true );

    });

    // Hide Comments
    $('.extendednews-no-comment .booster-block.booster-ratings-block, .extendednews-no-comment .comment-form-ratings, .extendednews-no-comment .twp-star-rating').hide();

    $('.tooltips').append("<span></span>");
    $(".tooltips").mouseenter(function(){
        $(this).find('span').empty().append($(this).attr('data-tooltip'));
    });

    // Scroll To
    $(".scroll-content").click(function () {
        $('html, body').animate({
            scrollTop: $(".site-content").offset().top
        }, 500);
    });

    // Rating disable
    if (extendednews_custom.single_post == 1 && extendednews_custom.extendednews_ed_post_reaction) {

        $('.tpk-single-rating').remove();
        $('.tpk-comment-rating-label').remove();
        $('.comments-rating').remove();
        $('.tpk-star-rating').remove();

    }

    // Add Class on article
    $('.theme-article-area').each(function () {
        $(this).addClass('theme-article-loaded');
    });

    // Aub Menu Toggle
    $('.submenu-toggle').click(function () {

        $(this).toggleClass('button-toggle-active');
        var currentClass = $(this).attr('data-toggle-target');
        $(currentClass).toggleClass('submenu-toggle-active');

    });

    // Header Search show
    $('.header-searchbar').click(function () {

        $('.header-searchbar').removeClass('header-searchbar-active');

    });

    $(".header-searchbar-inner").click(function (e) {

        e.stopPropagation(); //stops click event from reaching document

    });

    // Header Search hide
    $('#search-closer').click(function () {

        $('.header-searchbar').removeClass('header-searchbar-active');
        setTimeout(function () {

            $('.navbar-control-search').focus();

        }, 300);

        $('body').removeClass('body-scroll-locked');

    });

    // Focus on search input on search icon expand
    $('.navbar-control-search').click(function(){

        $('.header-searchbar').toggleClass('header-searchbar-active');

        setTimeout(function () {

            $('.header-searchbar .search-field').focus();
        }, 300);

        $('body').addClass('body-scroll-locked');

    });

    $( 'input, a, button' ).on( 'focus', function() {
        if ( $( '.header-searchbar' ).hasClass( 'header-searchbar-active' ) ) {

            if( $(this).hasClass('skip-link-search-top') ){
                $('.header-searchbar #search-closer').focus();
            }

            if (  ! $( this ).parents( '.header-searchbar' ).length ) {
                $('.header-searchbar .search-field').focus();
            }
        }
    } );

    $(document).keyup(function(j) {
        if (j.key === "Escape") { // escape key maps to keycode `27`
            if ( $( '.header-searchbar' ).hasClass( 'header-searchbar-active' ) ) {

                 $('.header-searchbar').removeClass('header-searchbar-active');
                 $('body').removeClass('body-scroll-locked');

                setTimeout(function () {
                    $('.navbar-control-search').focus();
                }, 300);

            }

            if ( $( 'body' ).hasClass( 'extendednews-trending-news-active' ) ) {

                $('.trending-news-main-wrap').slideToggle();
                $('body').toggleClass('extendednews-trending-news-active');
                $('.navbar-control-trending-news').focus();
            }
        }
    });

    // Action On Esc Button
    $(document).keyup(function (j) {
        if (j.key === "Escape") { // escape key maps to keycode `27`

            if( $('#offcanvas-menu').hasClass('offcanvas-menu-active') ){

                $('.header-searchbar').removeClass('header-searchbar-active');
                $('#offcanvas-menu').removeClass('offcanvas-menu-active');
                $('.navbar-control-offcanvas').removeClass('active');
                $('body').removeClass('body-scroll-locked');

                setTimeout(function () {
                    $('.navbar-control-offcanvas').focus();
                }, 300);

            }
        }
    });

    // Toggle Menu
    $('.navbar-control-offcanvas').click(function () {

        $(this).addClass('active');
        $('body').addClass('body-scroll-locked');
        $('#offcanvas-menu').toggleClass('offcanvas-menu-active');
        $('.button-offcanvas-close').focus();

    });

    // Offcanvas Close
    $('.offcanvas-close .button-offcanvas-close').click(function () {

        $('#offcanvas-menu').removeClass('offcanvas-menu-active');
        $('.navbar-control-offcanvas').removeClass('active');
        $('body').removeClass('body-scroll-locked');

        setTimeout(function () {
            $('.navbar-control-offcanvas').focus();
        }, 300);

    });

    // Offcanvas Close
    $('#offcanvas-menu').click(function () {

        $('#offcanvas-menu').removeClass('offcanvas-menu-active');
        $('.navbar-control-offcanvas').removeClass('active');
        $('body').removeClass('body-scroll-locked');

    });

    $(".offcanvas-wraper").click(function (e) {

        e.stopPropagation(); //stops click event from reaching document

    });

    // Offcanvas re focus on close button
    $('input, a, button').on('focus', function () {
        if ($('#offcanvas-menu').hasClass('offcanvas-menu-active')) {

            if( $(this).hasClass('skip-link-off-canvas') ){

                if( !$("#offcanvas-menu #social-nav-offcanvas").length == 0 ){

                    $("#offcanvas-menu #social-nav-offcanvas ul li:last-child a").focus();

                }else if( !$("#offcanvas-menu #primary-nav-offcanvas").length == 0 ){

                    $("#offcanvas-menu #primary-nav-offcanvas ul li:last-child a").focus();

                }
            }

           
            
        }
    });

    $('.skip-link-offcanvas').focus(function(){

        $(".button-offcanvas-close").focus();

    });

    // Sidr WidgetArea

    if ($("body").hasClass("rtl")) {
        $('#widgets-nav').sidr({
            name: 'sidr-nav',
            side: 'right'
        });
    } else {
        $('#widgets-nav').sidr({
            name: 'sidr-nav',
            side: 'left'
        });
    }
    $('#hamburger-one').click(function () {
        $(this).toggleClass('active');

        if(  $(this).hasClass('active') ){
            $('body').addClass('body-scroll-locked');
        }else{
            $('body').removeClass('body-scroll-locked');
        }

        setTimeout(function () {
            $('.sidr-offcanvas-close').focus();
        }, 300);

    });
    $('.sidr-offcanvas-close').click(function () {

        $.sidr('close', 'sidr-nav');

        $('#hamburger-one').removeClass('active');

        $('body').removeClass('body-scroll-locked');

        setTimeout(function () {
            $('#hamburger-one').focus();
        }, 300);

    });
    $( 'input, a, button' ).on( 'focus', function() {
        if ( $( 'body' ).hasClass( 'sidr-nav-open' ) ) {

            if ( $( this ).hasClass( 'skip-link-offcanvas-first' ) ) {
                $('.skip-link-offcanvas-last').focus();
            }

            if ( ! $( this ).parents( '#sidr-nav' ).length ) {
                $('.sidr-offcanvas-close').focus();
            }
        }
    } );

    $(document).keyup(function (j) {
        if( $('body').hasClass('sidr-nav-open') ){

            if (j.key === "Escape") { // escape key maps to keycode `27`

                $.sidr('close', 'sidr-nav');
                $('#hamburger-one').removeClass('active');
                $('body').removeClass('body-scroll-locked');
                setTimeout(function () {
                    $('#hamburger-one').focus();
                }, 300);

            }
        }
    });

    // Trending News Start

    $('.navbar-control-trending-news').click(function(){

        $('.trending-news-main-wrap').slideToggle();
        $('body').toggleClass('extendednews-trending-news-active');
        $('#trending-collapse').focus();

    });

    $('.extendednews-skip-link-end').focus(function(){
        $('#trending-collapse').focus();
    });

    $('.extendednews-skip-link-start').focus(function(){
        $('.trending-news-main-wrap .column:last-child .entry-meta a').focus();
    });

    $('#trending-collapse').click(function(){

        $('.trending-news-main-wrap').slideToggle();
        $('body').toggleClass('extendednews-trending-news-active');
        $('.navbar-control-trending-news').focus();

    });

    // Trending News End

    // Single Post content gallery slide
    $("ul.wp-block-gallery.columns-1, .wp-block-gallery.columns-1 .blocks-gallery-grid, .gallery-columns-1").each(function () {
        $(this).slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            fade: true,
            autoplay: false,
            autoplaySpeed: 8000,
            infinite: true,
            nextArrow: '<button type="button" class="slide-btn slide-btn-bg slide-next-icon">'+extendednews_custom.next_svg+'</button>',
            prevArrow: '<button type="button" class="slide-btn slide-btn-bg slide-prev-icon">'+extendednews_custom.prev_svg+'</button>',
            dots: false,
        });
    });

    // Content Gallery popup Start
    $('.entry-content .gallery, .widget .gallery, .wp-block-gallery').each(function () {
        $(this).magnificPopup({
            delegate: 'a',
            type: 'image',
            closeOnContentClick: false,
            closeBtnInside: false,
            mainClass: 'mfp-with-zoom mfp-img-mobile',
            image: {
                verticalFit: true,
                titleSrc: function (item) {
                    return item.el.attr('title');
                }
            },
            gallery: {
                enabled: true
            },
            zoom: {
                enabled: true,
                duration: 300,
                opener: function (element) {
                    return element.find('img');
                }
            }
        });
    });

    // Content Gallery popup End

    

    // Carousel Block Home
    $(".theme-carousel-slider").each(function () {

        $(this).slick({
            slidesToShow: 4,
            slidesToScroll: 4,
            autoplaySpeed: 8000,
            infinite: true,
            prevArrow: $(this).closest('.theme-block-carousel').find('.slide-prev-1'),
            nextArrow: $(this).closest('.theme-block-carousel').find('.slide-next-1'),
            responsive: [
                {
                    breakpoint: 991,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });

    });

    // Carousel Block Home
    $(".theme-carousel-sliderwidget").each(function () {

        $(this).slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplaySpeed: 8000,
            infinite: true,
            prevArrow: $(this).closest('.theme-block-widgetarea').find('.slide-prev-1'),
            nextArrow: $(this).closest('.theme-block-widgetarea').find('.slide-next-1'),
            responsive: [
                {
                    breakpoint: 991,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });

    });

    // Slider Block Home Image and content
    $(".theme-slider-main").each(function () {

        $(this).slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            fade: true,
            autoplay: true,
            autoplaySpeed: 8000,
            infinite: true,
            dots: false,
            arrows: false,
            asNavFor: '.theme-slider-navigator',
        });

    });

    // Slider Block Home Navigation
    $('.theme-slider-navigator').slick({

        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: '.theme-slider-main',
        infinite: true,
        dots: false,
        arrows: false,
        focusOnSelect: true,
        responsive: [
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 640,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]

    });

     // Slider Block Home Image and content
    $(".theme-slider-main-1").each(function () {

        $(this).slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            fade: true,
            autoplay: true,
            autoplaySpeed: 8000,
            infinite: true,
            nextArrow: '<button type="button" class="slide-btn slide-btn-bg slide-next-icon">'+extendednews_custom.next_svg+'</button>',
            prevArrow: '<button type="button" class="slide-btn slide-btn-bg slide-prev-icon">'+extendednews_custom.prev_svg+'</button>',
            dots: false,
        });

    });

    // Banner Block 1
    $(".theme-slider-block").each(function () {

        $(this).slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            fade: true,
            autoplay: false,
            autoplaySpeed: 8000,
            infinite: true,
            prevArrow: $(this).closest('.theme-block-elements').find('.slide-prev-lead'),
            nextArrow: $(this).closest('.theme-block-elements').find('.slide-next-lead'),
            dots: false,
        });

    });

     // Banner Block 1
    $(".theme-main-slider-block").each(function () {

        $(this).slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            fade: true,
            autoplay: false,
            autoplaySpeed: 8000,
            infinite: true,
            prevArrow: $(this).closest('.theme-main-banner').find('.slide-prev-lead'),
            nextArrow: $(this).closest('.theme-main-banner').find('.slide-next-lead'),
            dots: false,
        });

    });

    if( extendednews_custom.wide_layout ){
        var slideToShow = 4;
    }else{
        var slideToShow = 3;
    }
    // Ticker Post Slider
    $(".ticker-slides").each(function () {

        $(this).slick({
            slidesToShow: slideToShow,
            slidesToScroll: 1,
            fade: false,
            draggable: true,
            autoplay: true,
            autoplaySpeed: 1000,
            infinite: true,
            nextArrow: '.slide-next-ticker',
            prevArrow: '.slide-prev-ticker',
            dots: false,
            responsive: [
                {
                    breakpoint: 1400,
                    settings: {
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 991,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });

        // Pause Autoplay on click
        $('.ticker-control-pause').click(function() {
            $('.ticker-slides').slick('slickPause');
            $(this).removeClass('pp-button-active');
            $('.ticker-control-play').addClass('pp-button-active');
        });

        // Autoplay active on click
        $('.ticker-control-play').click(function() {
            $('.ticker-slides').slick('slickPlay');
            $(this).removeClass('pp-button-active');
            $('.ticker-control-pause').addClass('pp-button-active');
        });


    });



    $(".main-banner-vertical").each(function () {

        $(this).slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 8000,
            speed: 1000,
            vertical: true,
            verticalSwiping: true,
            prevArrow: $(this).closest('.main-banner-vertical-nav').find('.slide-prev-lead'),
            nextArrow: $(this).closest('.main-banner-vertical-nav').find('.slide-next-lead'),
            focusOnSelect: true
            
        });

    });

    var pageSection = $(".data-bg");
    pageSection.each(function (indx) {

        if ($(this).attr("data-background")) {

            $(this).css("background-image", "url(" + $(this).data("background") + ")");

        }

    });

    // Masonry Grid
    if ($('.archive-layout-masonry').length > 0) {

        /*Default masonry animation*/
        var grid;
        var hidden = 'scale(0.5)';
        var visible = 'scale(1)';
        grid = $('.archive-layout-masonry').imagesLoaded(function () {
            grid.masonry({
                itemSelector: '.theme-article-area',
                hiddenStyle: {
                    transform: hidden,
                    opacity: 0
                },
                visibleStyle: {
                    transform: visible,
                    opacity: 1
                }
            });
        });

    }

    // Sticky Components
    $('.widget-area, .post-content-share').theiaStickySidebar({
        additionalMarginTop: 30
    });

    // Widget Tab
    $('.twp-nav-tabs .tab').on('click', function (event) {

        var tabid = $(this).attr('id');
        $(this).closest('.tabbed-container').find('.tab').removeClass('active');
        $(this).addClass('active');
        $(this).closest('.tabbed-container').find('.tab-pane').removeClass('active');
        $('#content-' + tabid).addClass('active');

    });

    // Scroll to Top on Click
    $(window).scroll(function () {

        if ($(window).scrollTop() > $(window).height() / 2) {

            $(".scroll-up").fadeIn(300);

        }else{

            $(".scroll-up").fadeOut(300);

        }
    });

    // Scroll to Top on Click
    $('.scroll-up').click(function () {

        $("html, body").animate({
            scrollTop: 0
        }, 700);

        return false;

    });

});


/*  -----------------------------------------------------------------------------------------------
    Intrinsic Ratio Embeds
--------------------------------------------------------------------------------------------------- */

var extendednews = extendednews || {},
    $ = jQuery;

var $doc = $(document),
    $win = $(window),

viewport = {};
viewport.top = $win.scrollTop();
viewport.bottom = viewport.top + $win.height();

extendednews.instrinsicRatioVideos = {

    init: function () {

        extendednews.instrinsicRatioVideos.makeFit();

        $win.on('resize fit-videos', function () {

            extendednews.instrinsicRatioVideos.makeFit();

        });

    },

    makeFit: function () {

        var vidSelector = "iframe, object, video";

        $(vidSelector).each(function () {

            var $video = $(this),
                $container = $video.parent(),
                iTargetWidth = $container.width();

            // Skip videos we want to ignore
            if ($video.hasClass('intrinsic-ignore') || $video.parent().hasClass('intrinsic-ignore')) {
                return true;
            }

            if (!$video.attr('data-origwidth')) {

                // Get the video element proportions
                $video.attr('data-origwidth', $video.attr('width'));
                $video.attr('data-origheight', $video.attr('height'));

            }

            // Get ratio from proportions
            var ratio = iTargetWidth / $video.attr('data-origwidth');

            // Scale based on ratio, thus retaining proportions
            $video.css('width', iTargetWidth + 'px');
            $video.css('height', ($video.attr('data-origheight') * ratio) + 'px');

        });

    }

};

$doc.ready(function () {

    extendednews.instrinsicRatioVideos.init();      // Retain aspect ratio of videos on window resize

});

function ExtendedNews_SetCookie(cname, cvalue, exdays) {

  var d = new Date();
  d.setTime(d.getTime() + (exdays*24*60*60*1000));
  var expires = "expires="+ d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";

}

function ExtendedNews_GetCookie(cname) {

  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');

  for(var i = 0; i <ca.length; i++) {

    var c = ca[i];

    while (c.charAt(0) == ' ') {

      c = c.substring(1);

    }

    if (c.indexOf(name) == 0) {

      return c.substring(name.length, c.length);
      
    }

  }

  return "";
}