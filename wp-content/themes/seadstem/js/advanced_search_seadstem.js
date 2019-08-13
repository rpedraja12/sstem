/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


jQuery(document).ready(function ($) {
//    jQuery(".dropdown .dropdown-menu a").on("click", function (event) {
//        console.log(jQuery(this).text());
//        console.log(event);
//    });

    $('.cmb-search-subjects .dropdown-item').on('click', function (event) {
        event.preventDefault();
        var optionSelected = $('#true-cmb-subjects').find('[data-value="' + $(this).data('value') + '"]');
        var optionsSelectedValue = optionSelected.prop('selected');
        optionSelected.prop('selected', !optionsSelectedValue);
        toggleSearchFieldSelected($('#true-cmb-subjects'), $('#cmb-search-subjects'));
        checkEmptyAndSubmitForm();
    });

    $('.cmb-search-topics .dropdown-item').on('click', function (event) {
        event.preventDefault();
        console.log($(this).data('value'));
        var optionSelected = $('#true-cmb-topics').find('[data-value="' + $(this).data('value') + '"]');
        var optionsSelectedValue = optionSelected.prop('selected');
        optionSelected.prop('selected', !optionsSelectedValue);
        toggleSearchFieldSelected($('#true-cmb-topics'), $('#cmb-search-topics'));
        checkEmptyAndSubmitForm();
    });

    $('.cmb-search-level .dropdown-item').on('click', function (event) {
        event.preventDefault();
        console.log($(this).data('value'));
        var optionSelected = $('#true-cmb-level').find('[data-value="' + $(this).data('value') + '"]');
        var optionsSelectedValue = optionSelected.prop('selected');
        optionSelected.prop('selected', !optionsSelectedValue);
        toggleSearchFieldSelected($('#true-cmb-level'), $('#cmb-search-level'));
        checkEmptyAndSubmitForm();
    });


    $('.cmb-search-post-types .dropdown-item').on('click', function (event) {
        event.preventDefault();
        console.log($(this).data('value'));
        var optionSelected = $('#true-cmb-post-types').find('[data-value="' + $(this).data('value') + '"]');
        var optionsSelectedValue = optionSelected.prop('selected');
        optionSelected.prop('selected', !optionsSelectedValue);
        toggleSearchFieldSelected($('#true-cmb-post-types'), $('#cmb-search-post-types'));
        checkEmptyAndSubmitForm();
    });

    $('#search-btn').on('click', function () {
        checkEmptyAndSubmitForm();
    });

    $('#search-btn-mobile').on('click', function () {
        $('#search-txt').val($('#search-txt-mobile').val());
        checkEmptyAndSubmitForm();
    });


    function checkEmptyAndSubmitForm() {
        if ($('#search-txt').val() == "") {
            $('#search-txt').val("-custom-filter-");
        }
        $('#search-form').submit();
    }


    function toggleSearchFieldSelected(true_cmb_section, fake_cmb_selection) {
//        console.log(true_cmb_section);
//        console.log(fake_cmb_selection);
        unselectAllSearchField(fake_cmb_selection);
        true_cmb_section.find(':selected').each(function (index, item) {
            console.log($(item).data('value'));
            fake_cmb_selection.find('[data-value="' + $(item).data('value') + '"] i').addClass('fa-circle');
            fake_cmb_selection.find('[data-value="' + $(item).data('value') + '"]').addClass('t-gray-o');
        });
    }

    function unselectAllSearchField(face_cmb_selection) {
        face_cmb_selection.find('i.fa.fa-circle').removeClass('fa-circle').addClass('fa-circle-o');
        face_cmb_selection.find('.t-gray-o').removeClass('t-gray-o');
    }

    $('.search-tag .remove-search-tag').on('click', function () {
        var $cmbOption = $('#' + $(this).data('key'));
        console.log($(this).data('key'));
        var optionSelected = $(this).data('value');
        console.log(optionSelected);
        $cmbOption.find('[data-value="' + optionSelected + '"]').prop('selected', false);
        $('#search-form').submit();
    });

});



