<div class="container-fluid">
    <!-- /.row -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">{{ (isset($location->id)) ?  __('Edit location') :__('Add Location')}}</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">

                        <div class="form-group">
                            <a href="{{route('admin.locations.create')}}" type="submit" class="btn  btn-success btn-lg"><i class="fa fa-user-plus"></i>
                                {{__('Add new Location')}}
                            </a>
                        </div>

                        <form class="form-horizontal" method="POST"
                              action="{{ (isset($location->id)) ? route('admin.locations.update',['users'=>$location->id]) : route('admin.locations.store')   }}">
                            @csrf
                            @if(isset($location->id))
                                <input type="hidden" name="_method" value="PUT">

                            @endif
                            <div class="form-body">
                                @if (count($errors) > 0)

                                    <div class="row">
                                        <div class="col-md-12">
                                            @foreach ($errors->all() as $error)
                                                <div class="alert alert-danger">{{ $error }}</div>
                                            @endforeach

                                        </div>

                                    </div>
                                @endif

                                @if (session('status'))
                                    <div class="row">
                                        <div class="col-md-12">


                                            <div class=" alert alert-success">{{ session('status') }}</div>


                                        </div>
                                    </div>


                                @endif


                                <div class="form-group">
                                    <label for="title" class="col-md-12">{{__('Location name')}}
                                        <span class="help">{{__('e.g. "Airport"')}}</span></label>
                                    <div class="col-md-12">
                                        <input id="title" type="text" class="form-control" name="title"
                                               value="{{  old('title', isset($location->title) ? $location->title : '' )  }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="alias" class="col-md-12">{{__('Location alias')}} <span
                                                class="help">{{__('admin.category-alias-description')}}</span></label>
                                    <div class="col-md-12">
                                        <input id="alias" type="text" name="alias" class="form-control"
                                               value="{{  old('alias', isset($location->alias) ? $location->alias : '' )  }}">
                                    </div>
                                </div>

                            </div>

                            <button type="submit"
                                    class="btn btn-success waves-effect waves-light m-r-10" style="margin-left: 8px;">
                                @if(isset($location->id))
                                    {{__('Update Location')}}
                                @else
                                    {{__('Add new Location')}}
                                @endif
                            </button>


                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>

</div>