"use strict";
jQuery(document).ready(function ($) {

    // $('.iconpicker').iconpicker({
    //     iconset: 'fontawesome',
    // });
    $("body").on("click", ".about_us .btn-add", function () {
        console.log(1);
        var formRow = $(this).closest('.social-icon-group');
        var clone = formRow.clone();
        clone = clone.html()
            .replace('btn-success', 'btn-danger')
            .replace('btn-add', 'btn-delete')
            .replace('glyphicon-plus', 'glyphicon-minus');

        clone = '<div class="entry input-group  social-icon-group ">' + clone + '</div>';
        console.log(clone);
        $(this).closest('.social-icon-group-all').append(clone);
        $('.iconpicker').iconpicker();
    });
    $("body").on("click", ".about_us .btn-delete", function () {
        $(this).closest('.social-icon-group').remove();
    });


});