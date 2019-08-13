/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


jQuery(document).ready(function ($) {

    jQuery('.collapse').on('shown.bs.collapse', function () {
        jQuery(this).parent().find(".fa-plus").removeClass("fa-plus").addClass("fa-minus");
    }).on('hidden.bs.collapse', function () {
        jQuery(this).parent().find(".fa-minus").removeClass("fa-minus").addClass("fa-plus");
    });

    jQuery('.ron-scroller').each(function (index, scroller) {
        var scrollerId = jQuery(scroller).attr('id');
        jQuery('#'+scrollerId).owlCarousel({
            loop: true,
            margin: 10,
            responsiveClass: true,
            nav : false,
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

    jQuery('#btn-history-back').click(function(event) {
        event.preventDefault();
        //console.log('here');
        window.history.go(-1);
    });
    

});
