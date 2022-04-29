<div class="container-fluid">
    <!-- /.row -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">{{__('admin.Edit Category')}}
                </div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <div class="">

                            <form method="post"


                                  action="{{ $route ??  route('admin.categories.update',['categories'=>$category->id])}}">
                                @csrf
                                <input type="hidden" name="_method" value="PUT">
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
                                    <label for="exampleInputuname">{{__('admin.Name')}}</label>

                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="ti-arrow-right"></i></div>
                                        <input name="title" type="text" class="form-control" id="exampleInputuname"
                                              value="{{  old('title', isset($category->title) ? $category->title : '' )  }}"  placeholder="title">


                                    </div>
                                    <small>{{__('admin.The name is how it appears on your site.')}}</small>

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{{__('admin.Alias')}}</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="ti-arrow-right"></i></div>
                                        <input type="text" name="alias" class="form-control" id="exampleInputEmail1"
                                             value="{{  old('alias', isset($category->alias) ? $category->alias : '' )  }}"   placeholder="Slug"></div>
                                    <small>
                                        {{__('admin.category-alias-description')}}

                                    </small>

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputpwd1">{{__('admin.Parent Category')}}</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="ti-arrow-right"></i></div>


                                        <select id="exampleInputpwd1" name="parent_id" class="form-control">
                                            <option class="level-0" value="0">{{__('admin.None')}}</option>
                                            {!! $categories !!}

                                        </select>
                                    </div>
                                    <small>
                                        {{__('admin.category-description')}}

                                    </small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputpwd2">{{__('admin.Category Description')}}</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="ti-arrow-right"></i></div>
                                        <textarea name="description" id="exampleInputpwd2" class="form-control"
                                                  rows="5">{{  old('description', isset($category->description) ? $category->description : '' )  }}</textarea>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-block btn-success"><i
                                            class="fa fa-check"></i>


                                    {{__('admin.save')}}

                                </button>

                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

