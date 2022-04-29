jQuery(document).ready(function () {


    if (getUrlParameter('live_edit')) {
        var dialog;

        $.ajax({
            url: page_builder_obj.get_html,
            type: 'get',
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            data: [],
            success: function (date) {

                $('body').append(date);


                $('body').append('  <!-- Modal -->\n' +
                    '  <div class="modal fade" id="editModal" role="dialog">\n' +
                    '    <div class="modal-dialog modal-lg">\n' +
                    '    \n' +
                    '      <!-- Modal content-->\n' +
                    '      <div class="modal-content">\n' +
                    '        <div class="modal-header">\n' +
                    '          <button type="button" class="close" data-dismiss="modal">&times;</button>\n' +
                    '          <h4 class="modal-title">Loading</h4>\n' +
                    '        </div>\n' +
                    '        <div class="modal-body">\n' + ' </div>\n' +
                    '        <div class="modal-footer">\n' +
                    '          <button id="editModal-save" type="button" class="btn btn-primary">Save</button>\n' +
                    '          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>\n' +
                    '          <input type="hidden" class="module-id" value="" data-dismiss="modal">\n' +
                    '        </div>\n' +
                    '      </div>\n' +
                    '      \n' +
                    '    </div>\n' +
                    '  </div>');
                pBContentEmpty();

                $('.pb-module-section').each(function (e) {
                    $(this).prepend('<div class="pb-edit-section" > <div title="Edit section" class="pb-edit"><i class="fa fa-cogs" aria-hidden="true"></i></div><div  title="Delete section" class="pb-delete"><i class="fa fa-trash" aria-hidden="true"></i></div></div>');
                });


                $(".pb-sidebar  .module-item").draggable({
                    containment: "window",
                    distance: 2,
                    scroll: false,
                    zIndex: 100,
                    connectToSortable: ".pb-edit-content",
                    helper: function (e) {
                        return $(this).clone();
                    },
                    start: function (event, ui) {
                        inputType = ui.helper.data("input-type");
                        console.log("Start Drag of type: " + inputType);
                    }
                });
            }

        });

        /*
        pb edit modal windows
        */
        var editor;
        var pb_admin_page_date = $('.pb-admin-page-date');
        $("body").on("click", ".pb-edit-section .pb-edit", function () {


            var module_id = $(this).parent().parent().attr('id');
            var pb_admin_page_date = $('.pb-admin-page-date');
            $.ajax({
                url: page_builder_obj.get_module_options,
                type: 'post',
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    module_id: module_id,
                    id: pb_admin_page_date.data('id'),
                    type: pb_admin_page_date.data('type')
                },
                //   processData: false,
                success: function (date) {
                    $("#editModal .modal-body").html(date);
                    $("#editModal .module-id").val(module_id);

                    if ($("#pb-module-options-code").length > 0) {

                        editor = ace.edit("pb-module-options-code", {
                            mode: "ace/mode/html",
                            selectionStyle: "php"
                        });
                        editor.setOptions({
                            theme: "ace/theme/cobalt",
                            maxLines: 40,
                            autoScrollEditorIntoView: true,
                            copyWithEmptySelection: true,
                            useWrapMode: true,   // wrap text to view
                            indentedSoftWrap: false,
                            behavioursEnabled: false, // disable autopairing of brackets and tags
                            showLineNumbers: false, // hide the gutter
                            // theme: "ace/theme/xcode"
                        });

                        editor.session.setMode("ace/mode/php");
                        $("#editModal").modal();
                        editor.resize();
                        editor.getSession().setUseWrapMode(true);
                    }
                },
                error: function (jqXHR, exception) {

                    $("#editModal .modal-body").html(jqXHR);
                    console.log(jqXHR.responseJSON.message);
                    $("#editModal").modal();

                }

            });

        });

        $("body").on("click", "#editModal-save", function () {

            $.ajax({
                url: page_builder_obj.save_module,
                type: 'post',
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    name: $("#editModal .module-id").val(),
                    id: pb_admin_page_date.data('id'),
                    type: pb_admin_page_date.data('type'),
                    val: editor.getValue(),
                    form: $('.pb_options_form').length ? $('.pb_options_form').serialize() : ''
                },
                //   processData: false,
                success: function (date) {

                    var mid = $("#editModal .module-id").val();
                    console.log(mid);
                    $('#' + mid).replaceWith($(date).prepend(PbAddEditModuleButton()));
                    $("#editModal").modal('hide');
                },
                error: function (jqXHR, exception) {

                    alert(jqXHR.responseJSON.message);


                }
            });
        });


        /**
         *  end modal form
         *
         */

        $("body").on("click", ".pb-edit-section .pb-delete", function () {
            if (confirm("Are you sure want delete this section?")) {
                $(this).closest('.pb-module-section').remove();
                var module_id = $(this).parent().parent().attr('id');

                $.ajax({
                    url: page_builder_obj.delete_module,
                    type: 'post',
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        module_id: module_id,
                        id: pb_admin_page_date.data('id'),
                        type: pb_admin_page_date.data('type')
                    },
                    success: function (date) {
                        pBContentEmpty();
                    }

                });


            }

        });

        $("body").on("click", ".pb-sidebar .save-customize", function () {


            var hash = {};
            var this_b = $(this);


            $('.pb-edit-content  .pb-module-section').each(function (index, value) {
                //  console.log($(this).html());
                var i, n;
                // data[$(this).id()] = $(this).html();
                //var html = $(this).clone().html();
                var html = $("<div />").append($(this).clone());

                html.find('.pb-edit-section').remove();
                html = html.html();
                html = html.replace(/contenteditable="true"/g, "");

                hash[value.id] = html;
                //   console.log(hash[value.id]);
               /* sub = $(this).closest('.pb-module-section');

                if (sub.length) {
                    console.log(sub);
                    hash[value.id] = {
                        content: html,
                        parent: sub.attr('id')
                    }
                } else {
                    hash[value.id] = html;
                }*/
                /*if ($(this).attr('id') == 'faq_container__0') {
                    console.log(sub);
                }*/


            });


            console.log(hash);
            var pb_admin_page_date = $('.pb-admin-page-date');

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

            });
        });

        setTimeout(function () {
            $(".pb-edit-content .edit").attr('contenteditable', 'true');
        }, 500);

        var pb_admin_page_date = $('.pb-admin-page-date');

        $(".pb-edit-content").sortable({
            placeholder: 'pb-section-placeholder',
            cursor: 'move',
            cancel: 'p,span,a,h1,h2,h3,h4,h5.h6,b,strong,i,.caption-text',
            receive: function (event, ui) {

                var newItem;
                $.get(page_builder_obj.get_module, {
                    module: ui.helper.data('module-name'),
                    id: pb_admin_page_date.data('id'),
                    type: pb_admin_page_date.data('type')
                    //    module: 'breadcrumbs'
                }, function (data) {
                    data = $(data).prepend('<div class="pb-edit-section" > <div title="Edit section" class="pb-edit"><i class="fa fa-cogs" aria-hidden="true"></i></div><div  title="Delete section" class="pb-delete"><i class="fa fa-trash" aria-hidden="true"></i></div></div>');

                    // get new id
                    old_id = getNewId(data.attr('id'));
                    data.attr('id', old_id);

                    // replace content
                    ui.helper.replaceWith(data);


                    console.log("Placing new item, type: " + inputType);
                });
                $('.pb-edit-content').removeClass('empty');
                setTimeout(function () {
                    $(".pb-edit-content .edit").attr('contenteditable', 'true');

                }, 500);

            }
        });


        // end  live edit

        $("body").on("mousemove", ".pb-img-edit", function (e) {
            $('#pb-image-edit-nav').css({
                'top': $(this).offset().top,
                'left': $(this).offset().left
            });
            $('#pb-image-edit-nav').data('img', $(this));
            console.log(this.id);


        });
        $("body").on("click", ".pb-img-edit", function (event) {
            alert(1);
        });
    }

});

var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
};


function getNewId(old_id) {
    if ($("#" + old_id).length > 0) {
        old_id = old_id.replace(/__(\d+)$/, function (match, number) {

            return '__' + (parseInt(number) + 1);
        });
        old_id = getNewId(old_id);
    }
    return old_id;
}

function pBContentEmpty() {
    if ($('.pb-edit-content').html().replace(/\s/g, "").length < 10) {
        $('.pb-edit-content').addClass('empty');
    }
}

function PbAddEditModuleButton() {
    return '<div class="pb-edit-section" > <div title="Edit section" class="pb-edit"><i class="fa fa-cogs" aria-hidden="true"></i></div><div  title="Delete section" class="pb-delete"><i class="fa fa-trash" aria-hidden="true"></i></div></div>';
}