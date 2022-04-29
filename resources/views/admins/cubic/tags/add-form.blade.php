<h3 class="">{{  isset($tag->id) ?   __('admin.Edit Tag') : __('admin.Add New Tag')}}</h3>

<form method="post"

      action="{{ isset($tag->id) ? route('admin.post_tag.update',['tag' => $tag->id ]) : route('admin.post_tag.store')  }}">
    @csrf
    @if($tag->id ?? false)
        @method('PUT')
    @endif
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
        <label for="exampleInputuname">{{__('admin.Name')}} </label>

        <div class="input-group">
            <div class="input-group-addon"><i class="ti-arrow-right"></i></div>
            <input name="title" type="text" class="form-control" id="exampleInputuname"
                   value="{{  isset( $tag->title) ? $tag->title : old('title' )  }}" placeholder="{{__('admin.title')}}">


        </div>
        <small>{{__('admin.The name is how it appears on your site.')}}</small>

    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">{{__('admin.Alias')}}</label>
        <div class="input-group">
            <div class="input-group-addon"><i class="ti-arrow-right"></i></div>
            <input type="text" name="alias" class="form-control" id="exampleInputEmail1"
                   value="{{  isset( $tag->alias) ? $tag->alias : old('alias' )  }}" placeholder=" {{__('admin.Alias')}}">
        </div>
        <small>
            {{__('admin.category-alias-description')}}
        </small>

    </div>

    <div class="form-group">
        <label for="exampleInputpwd2">
            {{__('admin.Tag Description')}}

        </label>
        <div class="input-group">
            <div class="input-group-addon"><i class="ti-arrow-right"></i></div>
            <textarea name="description" id="exampleInputpwd2"
                      class="form-control"
                      rows="5">{{  isset( $tag->description) ? $tag->description : old('description' )  }}</textarea>
        </div>
    </div>

    <button type="submit" class="btn btn-block btn-success"><i
                class="fa fa-check"></i>
        {{ isset( $tag->id)  ?   __('admin.update') : __('admin.save')}}

    </button>

</form>


