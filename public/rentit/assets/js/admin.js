"use strict";
jQuery(document).ready(function ($) {

    // alert('3');
    // $('.iconpicker').iconpicker({
    //     iconset: 'fontawesome',
    // });
    var button_add_img;
    $("body").on("click", ".social-button-items .btn-add", function () {

        var formRow = $(this).closest('.social-button-items');
        var clone = formRow.clone();
        clone = clone.html()
            .replace('btn-success', 'btn-danger')
            .replace('btn-add', 'btn-delete')
            .replace('glyphicon-plus', 'glyphicon-minus');

        clone = '<div class="social-button-items ">' + clone + '</div>';
        $(this).closest('.social-button-items-all').append(clone);
        //  $('.social-button-items-all').append(clone);
        $('.iconpicker').iconpicker();
    });
    $("body").on("click", ".social-button-items .btn-delete", function () {
        console.log(0);
        $(this).closest('.social-button-items').remove();
    });



        $('.add-new-item').click(function (e) {
            e.preventDefault();
            console.log($(this).data('tr'));
            console.log($(this).closest('div'));
           $(this).closest('div').find('tbody').append($(this).data('tr'));
        });


        $("body").on("click", ".btn-delete", function (e) {
            e.preventDefault();
            $(this).closest('tr').remove();
        });






});