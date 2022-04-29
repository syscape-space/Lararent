<div class="container-fluid">
    <!-- /.row -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading"> {{__('admin.Roles')}}    </div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">

						<?php // dump(   Gate::abilities()); ?>


                        <div class="table-responsive ">
                            <table id="permison_table" class="table  display nowrap" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>{{__('admin.ID')}}</th>
                                    <th>{{__('admin.Role name')}}</th>
                                    <th>{{__('admin.permissions')}}</th>
                                    <th>{{__('admin.Actions')}}</th>

                                </tr>
                                </thead>


                                <tbody>
                                @if(isset($roles) && is_object($roles))
                                    @foreach($roles as $role     )

                                        <tr>

                                            <td>{{$role->id}}</td>
                                            <td>{{$role->name}}</td>
                                            <td>


                                                <div class="col-md-7">
                                                    <select class="form-control form-control-lg select2-multiple"
                                                            multiple>

                                                        @if(isset($permissions) && is_object($permissions))
                                                            @foreach($permissions as $permission     )

                                                                <option
                                                                        @if($role->hasPermission($permission->name))
                                                                        selected
                                                                        @endif

                                                                        value="{{$permission->id}}">{{$permission->name}}</option>
                                                            @endforeach
                                                        @endif


                                                    </select>
                                                </div>

                                            </td>

                                            <td>
                                                <button data-id="{{$role->id}}" class="btn  btn-success update_role "
                                                        data-toggle="tooltip" title=""
                                                        data-original-title="{{__('admin.save')}}"><i
                                                            class="fa fa-user-plus"></i>
                                                    {{__('admin.save')}}
                                                </button>
                                                <button data-id="{{$role->id}}" class="btn  btn-danger delete_role "
                                                        data-toggle="tooltip" title=""
                                                        data-original-title="{{__('admin.Delete')}}"><i
                                                            class="fa fa-user-plus"></i>
                                                    <i class="ti-trash"></i>
                                                    {{__('admin.Delete')}}
                                                </button>


                                            </td>


                                        </tr>

                                    @endforeach
                                @endif

                                </tbody>
                            </table>

                            <a href="{{route('admin.permissions.create')}}" type="submit"
                               class="btn  btn-success btn-lg btn-add-role"><i
                                        class="fa fa-user-plus"></i>
                                {{__('admin.Add Role')}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>


        <script src="/cubic/plugins/components/datatables/jquery.dataTables.min.js"></script>


        <!-- start - This is for export functionality only -->
        <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
        <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
        <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
        <!-- end - This is for export functionality only -->


        <script>
            jQuery(document).ready(function ($) {

                $(".select2-multiple").select2({
                    width: 450
                });
                var table = $('#permison_table').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        'copyHtml5', 'excelHtml5', 'pdfHtml5', 'csvHtml5'
                    ]
                });

                $("body").on("click", ".btn-add-role", function (e) {
                    e.preventDefault();


                    table.row.add([
                        $('#permison_table tr').length,
                        " <div class=\"form-group\">\n" +
                        "                                            <div class=\"col-md-12\">\n" +
                        "                                                <div class=\"input-group\">\n" +
                        "                                                    <input name='name' required type=\"text\" class=\"form-control\"\n" +
                        "                                                           id=\"exampleInputuname\" placeholder=\"{{__('admin.Role name')}}\"></div>\n" +
                        "                                            </div>\n" +
                        "                                      ",
                        "  <div class=\"col-md-7\">\n" +
                        "                                            <select  name='permission' class=\"col-md-12 form-control form-control-lg select2-multiple\" multiple>\n" +
                        "                                                \n" +
                        "                                                @if(isset($permissions) && is_object($permissions))\n" +
                        "                                                    @foreach($permissions as $permission     )\n" +
                        "                                                        <option\n" +
                        "                                                                \n" +
                        "                                                                value=\"{{$permission->id}}\">{{$permission->name}}</option>\n" +
                        "                                                    @endforeach\n" +
                        "                                                @endif\n" +
                        "\n" +
                        "\n" +
                        "                                            </select>\n" +
                        "                                        </div>",
                        "  <button data-id='' class=\"btn  btn-success add_role \" data-toggle=\"tooltip\" title=\"\" data-original-title=\"{{__('admin.save')}}\"><i class=\"fa fa-user-plus\"></i>\n" +
                        "                                                    {{__('admin.save')}}\n" +
                        "                                                </button>\n" +
                        "                                                <button data-id='' class=\"btn  btn-danger \"   data-toggle=\"tooltip\" title=\"\" data-original-title=\"{{__('admin.Delete')}}\"><i class=\"fa fa-user-plus\"></i>\n" +
                        "                                                    <i class=\"ti-trash\"></i>\n" +
                        "                                                    {{__('admin.Delete')}}\n" +
                        "                                                </button>"

                    ]).draw(false);
                    $(".select2-multiple").select2({
                        width: 450
                    });
                });


                $("body").on("click", ".add_role", function (e) {
                    e.preventDefault();
                    $('.preloader').show().css('opacity', '0.3');
                    var this_v = $(this);
                    data = {};
                    data['name'] = this_v.closest('tr').find('input').val();
                    data['perms'] = (this_v.closest('tr').find('select').val());
                    $.ajax({
                        url: '{{route('admin.permissions.store')}}',
                        type: 'post', // replaced from put
                        data: data,
                        headers: {
                            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (r) {
                            //   $(this_v).closest('tr').remove();
                            $('.preloader').hide();
                        },
                        error: function (msg) {
                            $('.preloader').hide();
                        }
                    });
                });


                $("body").on("click", ".update_role", function (e) {

                    e.preventDefault();
                    $('.preloader').show().css('opacity', '0.3');
                    var this_v = $(this);
                    data = {};


                    data['perms'] = (this_v.closest('tr').find('select').val());
                    data['id'] = (this_v.data('id'));
                    $.ajax({
                        url: '{{route('admin.permissions.store')}}/' + this_v.data('id'),
                        type: 'PUT', // replaced from put
                        data: data,
                        headers: {
                            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (r) {
                            //   $(this_v).closest('tr').remove();
                            $('.preloader').hide();
                        },
                        error: function (msg) {
                            $('.preloader').hide();
                        }
                    });
                });

                $("body").on("click", ".delete_role", function (e) {

                    e.preventDefault();

                    $('.preloader').show().css('opacity', '0.3');
                    var this_v = $(this);
                    var data = {};


                    data['perms'] = (this_v.closest('tr').find('select').val());
                    data['id'] = (this_v.data('id'));
                    $.ajax({
                        url: '{{route('admin.permissions.store')}}/' + this_v.data('id'),
                        type: 'DELETE', // replaced from put
                        data: data,
                        headers: {
                            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (r) {
                            console.log(r.error);

                            if(r.error){
                                alert(r.error);
                            } else {
                                $(this_v).closest('tr').remove();

                            }
                            $('.preloader').hide();
                        },
                        error: function (msg) {
                            $('.preloader').hide();
                        }
                    });
                });

            });
        </script>

