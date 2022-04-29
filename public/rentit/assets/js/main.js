'use strict';

jQuery(document).ready(function ($) {

    /**
     * Ajax login
     */


    $("body").on("click", ".btn-apply-coupon", function (e) {
        $.ajax({
            url: rentit_obj.coupon,
            type: 'POST',
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            data: $('form.table-responsive').serialize(),
            success: function (date) {
             $('.cart-total').html(date);
            },
            error: function (res) {

            }

        });
    });


    $("body").on("submit", ".rentit-form-login", function (e) {
//e.preventDefault();
//alert(1);

        /*
                $.ajax({
                    url: page_builder_obj.save,
                    type: 'post',
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    //     contentType: "application/json; charset=utf-8",
                    //    dataType: "json",
                    data: {
                        modules: hash,
                        id: pb_admin_page_date.data('id'),
                        type: pb_admin_page_date.data('type')
                    },
                    //   processData: false,
                    success: function (date) {
                        this_b.prop("disabled", false);


                        alert('Saved successful!');

                    }

                });*/
    });


    /*
    *  Form boging chnaged
     */
    formBookingChanged();

    function formBookingChanged() {
        if ($('.widget-details-reservation .widget-content').length > 0) {
            $('.widget-details-reservation .widget-content').css('opacity', '0.5');
            $.ajax({
                url: rentit_obj.PreviewReservation,
                type: 'POST',
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                data: $('.form-booking_a_car').serialize(),
                success: function (date) {
                    $('.widget-details-reservation .widget-content').html(date);
                    $('.widget-details-reservation .widget-content').css('opacity', '1');
                },
                error: function (res) {
                    $('.widget-details-reservation .widget-content').html(JSON.parse(res.responseText).message);
                    $('.widget-details-reservation .widget-content').css('opacity', '1');
                }

            });
        }
    }


    $('.form-booking_a_car').on('keyup change paste', 'input, select, textarea', function () {

        //console.log($(this).serialize());
        ///console.log($(this).serialize());
        formBookingChanged();
        //alert(1);
        // $(this).closest('form').data('changed', true);
    });


    var nowDate = new Date();
    var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);


    /**
     * Home calendars
     */

    jQuery('.PickingUpDate').datetimepicker({
        minDate: today,
        format: rentit_obj.date_format,
        locale: rentit_obj.lang,
        disabledDates: rentit_obj.reserved_date

    });
    jQuery('.DroppingOffDate').datetimepicker({
        minDate: today,
        format: rentit_obj.date_format,
        locale: rentit_obj.lang,
        disabledDates: rentit_obj.reserved_date

    });


    jQuery(".PickingUpDate").on("dp.change", function (e) {
        formBookingChanged();
        jQuery(".DroppingOffDate").data("DateTimePicker").minDate(e.date);
        jQuery(".DroppingOffDate").val(moment(e.date).format(rentit_obj.date_format));
    });
    jQuery(".DroppingOffDate").on("dp.change", function (e) {
        formBookingChanged();
    });

    /**
     * MailChimp
     */


    $(document).on('submit', '.mail-chimp', function (e) {
        e.preventDefault();
        var this_f = $(this);
        this_f.find('.result').html(' ');
        var email_g = this_f.find('.form-group ').eq(0);
        var email = this_f.find('.form-group  input');
        email_g.removeClass('has-error has-danger');


        if (isValidEmailAddress(email.val())) {
            this_f.find('button').prop('disabled', true);
            email.prop('disabled', true);

            $.ajax({
                url: rentit_obj.news_letter_widget,
                type: 'POST',
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                data: 'email=' + email.val() + '&id=' + this_f.data('id') + '&key=' + this_f.data('key'),
                success: function (date) {

                    this_f.find('.result').append('<div class=\'alert alert-success fade in\'>' +
                        '<button class=\'close\' data-dismiss=\'alert\' type=\'button\'>&times;</button><strong>' +
                        '' + date + '' +
                        '</strong></div>');
                    //  $('.form-subscribe2')[0].reset();
                    this_f.find('button').prop('disabled', false);
                    email.prop('disabled', false);
                }

            });
        } else {
            email_g.addClass('has-error has-danger');
            console.log('invalid email');

        }
    });

    // payment radio
    $(document).on('click', '.payment-panel a.collapsed', function (e) {
        $(this).find('input').prop("checked", true);
        formBookingChanged();
    });


    $('.theme-config-head a').click(function (e) {
        e.preventDefault();
        if ($('#themeConfig').hasClass('active')) {
            $('#themeConfig').animate({
                right: '-' + $('#themeConfig').width() + 'px'
            }, 300).removeClass('active');
        } else {
            $('#themeConfig').animate({
                right: '0'
            }, 300).addClass('active');
        }
    });

});

function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^(('[\w-\s]+')|([\w-]+(?:\.[\w-]+)*)|('[\w-\s]+')([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
    return pattern.test(emailAddress);
}

