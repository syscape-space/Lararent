<div class="container-fluid">
    <!-- /.row -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading"> {{__('admin.users')}}    </div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <div class="form-group">
                            <a href="{{route('admin.users.create')}}" type="submit" class="btn  btn-success btn-lg"><i
                                        class="fa fa-user-plus"></i>
                                {{__('admin.add new user')}}
                            </a>
                        </div>



                        <div class="table-responsive ">
                            <table id="example23" class="table  display nowrap" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>{{__('admin.ID')}}</th>
                                    <th>{{__('admin.User login')}}</th>
                                    <th>{{__('admin.Name')}}</th>
                                    <th>{{__('admin.Email')}}</th>
                                    <th>{{__('admin.Role')}}</th>
                                    <th>{{__('admin.Actions')}}</th>

                                </tr>
                                </thead>

                                <tbody>
                                @if(isset($users) && is_object($users))
                                    @foreach($users as $user)
                                        <tr>

                                            <td>{{$user->id ?? ''}}</td>
                                            <td>{{$user->login ?? ''}}</td>
                                            <td>
                                                {{$user->name}}

                                            </td>
                                            <td>
                                            {{$user->email}}
                                            <td>
                                                {{  $user->roles->first()->name ?? '' }}

                                            </td>
                                            <td>
                                                <a href="{{ route('admin.users.edit',['users' => $user->id]) }}"
                                                   class="text-inverse p-r-10"
                                                   data-toggle="tooltip" title="" data-original-title="Edit"><i
                                                            class="ti-marker-alt"></i></a>

                                                @if($user->id != 1)

                                                    <a
                                                            href="javascript:void(0)"
                                                            class="text-inverse delete_post"
                                                            title="{{__('admin.Delete')}}"
                                                            data-id="{{$user->id}}"
                                                            data-toggle="tooltip"><i
                                                                class="ti-trash"></i></a>
                                                @endif


                                            </td>


                                        </tr>

                                    @endforeach
                                @endif


                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>




        <!-- start - This is for export functionality only -->
        {{--<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>--}}
        {{--<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>--}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
        <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
        <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
        {{--<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>--}}
        {{--<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>--}}
        <!-- end - This is for export functionality only -->

        <script>
            jQuery(document).ready(function ($) {


                $('#example23').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        'copyHtml5', 'excelHtml5', 'pdfHtml5', 'csvHtml5'
                    ]
                });


                $("body").on("click", ".delete_post", function (e) {

                    e.preventDefault();
                    $('.preloader').show().css('opacity', '0.3');
                    var this_v = $(this);

                    $.ajax({
                        url: '{{route('admin.users.index')}}/' + $(this).data('id'),
                        type: 'delete', // replaced from put
                        headers: {
                            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (r) {
                            $(this_v).closest('tr').remove();
                            $('.preloader').hide();
                        },
                        error: function (msg) {
                            $('.preloader').hide();
                        }
                    });
                });

            });
        </script>

