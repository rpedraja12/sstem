
jQuery(document).ready(function ($) {
    /* Ajax functions */
    $(document).on('click', '.seadstem-load-more', function () {

        var that = $(this);
        var page = $(this).data('page');
        var newPage = parseInt(page) + 1;
        var ajaxurl = that.data('url');
        var $content = $("body #category-isotope-container");
        var $subjects = [];
        $('#true-cmb-subjects :selected').each(function (index, item) {
            $subjects.push($(item).data('value'));
        });
        var $topics = [];
        $('#true-cmb-topics :selected').each(function (index, item) {
            $topics.push($(item).data('value'));
        });
        var $resourceTypes = [];
        $('#true-cmb-post-types :selected').each(function (index, item) {
            $resourceTypes.push($(item).data('value'));
        });
        console.log(page);
        $.ajax({
            url: ajaxurl,
            type: 'post',
            data: {
                subjects: $subjects,
                topics: $topics,
                resourceTypes: $resourceTypes,
                page: page,
                s: jQuery('#search-txt').val(),
                action: 'seadstem_load_more'

            },
            beforeSend: function () {

                $content.append('<div id="temp_load" style="text-align:center">\
                            <img src="' + templateUrl + '/img/ajax-loader.gif" />\
                            </div>');
                $('#next-container').addClass('d-none');

            },
            error: function (response) {
                console.log(response);
                $content.find('#temp_load').remove();
            },
            success: function (response) {
                $content.find('#temp_load').remove();
                $('.grid').append(response);
                $('#next-container').removeClass('d-none');
                $('.grid').imagesLoaded(function () {
                    $('.grid').isotope('reloadItems').isotope();
                    //$('.seadstem-load-more').data('page', $('.grid-item').length + 1);
                });
                if (parseInt($('#posts-num').data("items")) == $('.grid-item').length) {
                    $('#next-container').hide();
                }
                that.data('page', newPage)

            }

        });
    });

    /**
     * News load more
     */
    $(document).on('click', '.seadstem-news-load-more', function () {

        var that = $(this);
        var page = $(this).data('page');
        var newPage = parseInt(page) + 1;
        var ajaxurl = that.data('url');
        var $content = $("body .news-container");

        console.log(page);
        $.ajax({
            url: ajaxurl,
            type: 'post',
            data: {
                page: page,
                action: 'seadstem_news_load_more'

            },
//            beforeSend: function () {
//
//                $content.append('<div id="temp_load" style="text-align:center">\
//                            <img src="' + templateUrl + '/img/ajax-loader.gif" />\
//                            </div>');
//                $('#next-container').addClass('d-none');
//
//            },
            error: function (response) {
                console.log(response);
//                $content.find('#temp_load').remove();
            },
            success: function (response) {
//                $content.find('#temp_load').remove();
//                $('.grid').append(response);
//                $('#next-container').removeClass('d-none');
//                $('.grid').imagesLoaded(function () {
//                    $('.grid').isotope('reloadItems').isotope();
//                    //$('.seadstem-load-more').data('page', $('.grid-item').length + 1);
//                });
                $content.append(response);
//                $content.imagesLoaded(function(){
//                    alert('ding');
//                });
                if (parseInt($('.news-posts-num').data("items")) == $('.news-item-content').length) {
                    $('#news-next-container').hide();
                }
                that.data('page', newPage)
//                alert('ding ding motha fucker');
//                console.log(response);
            }

        });
    });

/**
     * events load more
     */
    $(document).on('click', '.seadstem-events-load-more', function () {

        var that = $(this);
        var page = $(this).data('page');
        var newPage = parseInt(page) + 1;
        var ajaxurl = that.data('url');
        var $content = $("body .events-container");

        console.log(page);
        $.ajax({
            url: ajaxurl,
            type: 'post',
            data: {
                page: page,
                action: 'seadstem_events_load_more'

            },
//            beforeSend: function () {
//
//                $content.append('<div id="temp_load" style="text-align:center">\
//                            <img src="' + templateUrl + '/img/ajax-loader.gif" />\
//                            </div>');
//                $('#next-container').addClass('d-none');
//
//            },
            error: function (response) {
                console.log(response);
//                $content.find('#temp_load').remove();
            },
            success: function (response) {
//                $content.find('#temp_load').remove();
//                $('.grid').append(response);
//                $('#next-container').removeClass('d-none');
//                $('.grid').imagesLoaded(function () {
//                    $('.grid').isotope('reloadItems').isotope();
//                    //$('.seadstem-load-more').data('page', $('.grid-item').length + 1);
//                });
                $content.append(response);
//                $content.imagesLoaded(function(){
//                    alert('ding');
//                });
                if (parseInt($('.events-posts-num').data("items")) == $('.events-item-content').length) {
                    $('#events-next-container').hide();
                }
                that.data('page', newPage)
//                alert('ding ding motha fucker');
                console.log(response);
            }

        });
    });
//    $('.grid').imagesLoaded(function () {
//
//        var $grid = jQuery('.grid');
//
//        $grid.isotope({
//            // options
//            itemSelector: '.grid-item',
////        layoutMode: 'fitRows',
////            percentPosition: true,
//            masonry: {
////            columnWidth: 100,
//                columnWidth: 50,
//                isFitWidth: true,
////                grid: 10
//            }
//        });
////        $grid.isotope( 'reloadItems' ).isotope();
//
////        var iso = $grid.data('isotope');
//
////        $grid.infiniteScroll({
////            path: 'a.pagination__next',
////            append: '.grid-item',
////            debug: true,
////            status: '.infinite-scroll-request',
////            outlayer: iso
////        }
////        );
//
//        // filter items on button click
////        $('.filter-button-group').on('click', 'button', function () {
////            var filterValue = $(this).attr('data-filter');
////            $grid.isotope({filter: filterValue});
////        });
//    });

    console.log('called');

    $('.grid').imagesLoaded(function () {
        var $grid = jQuery('.grid');
        $grid.isotope({
            itemSelector: '.grid-item',
            percentPosition: true,
            masonry: {
                columnWidth: '.grid-sizer',
//                gutter: 10,
            }
        });

    });



    $('#unit-scroller-container').owlCarousel({
        loop: true,
        margin: 10,
        responsiveClass: true,
        nav: false,
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            600: {
                items: 3,
                nav: false
            },
            1000: {
                items: 3,
                nav: true,
                loop: false
            }
        }
    });

});