/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

jQuery(document).ready(function () {
    jQuery('.dropdown').on('shown.bs.dropdown', function () {
        jQuery(this).addClass('gray');
    })
    jQuery('.dropdown').on('hidden.bs.dropdown', function () {
        jQuery(this).removeClass('gray');
    })
});

