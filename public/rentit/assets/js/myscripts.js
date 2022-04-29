jQuery(document).ready(function ($) {

    $('.commentlist li').each(function (i) {

        $(this).find('div.commentNumber').text('#' + (i + 1));

    });

    $('#commentform').on('click', '#submit', function (e) {

        e.preventDefault();


        var comParent = $(this);

        $('.wrap_result').css('color', 'green').text(window.i18n.admin.commentSaves).fadeIn(500, function () {

            var data = $('#commentform').serializeArray();

            console.log({
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({

                url: $('#commentform').attr('action'),
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                data: data,
                type: 'POST',
                datatype: 'JSON',
                success: function (html) {
                    if (html.error) {
                        $('.wrap_result').css('color', 'red').append('<br /><strond>'+ window.i18n.admin.commentError  +': </strong>' + html.error.join('<br />'));
                        $('.wrap_result').delay(2000).fadeOut(5000);
                    }
                    else if (html.success) {
                        $('.wrap_result')
                            .append('<br /><strong>' + window.i18n.admin.saved  + '!</strong>')
                            .delay(2000)
                            .fadeOut(500, function () {

                                if (html.data.parent_id > 0) {
                                    comParent.parents('div#respond').prev().after('<ul class="children">' + html.comment + '</ul>');
                                }
                                else {
                                    if ($.contains('#comments', '.commentlist')) {
                                        $('.commentlist').append(html.comment);
                                    }
                                    else {

                                        $('#respond').before('<ol class="commentlist group">' + html.comment + '</ol>');

                                    }
                                }


                                $('#cancel-comment-reply-link').click();
                            })

                    }


                },
                error: function () {
                    $('.wrap_result').css('color', 'red').append('<br /><strond>'+ window.i18n.admin.error  + ': </strong>');
                    $('.wrap_result').delay(2000).fadeOut(500, function () {
                        $('#cancel-comment-reply-link').click();
                    });

                }

            });
        });

    });

});