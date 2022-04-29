<h3 class="">
    @if($group)
        {{__('admin.Add New Group')}}
    @else
        {{__('admin.Add New Category')}}
    @endif

</h3>

<form method="post"

      action="{{  route('admin.products.categories.store')  }}">
    @csrf
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

    @if (session('error'))
        <div class="row">
            <div class="col-md-12">


                <div class="alert alert-danger">{{ session('error') }}</div>


            </div>
        </div>


    @endif
    <div class="form-group">
        <label for="exampleInputuname"> {{__('admin.Name')}}</label>

        <div class="input-group">
            <div class="input-group-addon"><i class="ti-arrow-right"></i></div>
            <input name="title" type="text" class="form-control" id="exampleInputuname"
                   value="{{  old('title' )  }}" placeholder="title">


        </div>
        <small> {{__('admin.The name is how it appears on your site.')}}</small>

    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">{{__('admin.Alias')}}</label>
        <div class="input-group">
            <div class="input-group-addon"><i class="ti-arrow-right"></i></div>
            <input type="text" name="alias" class="form-control" id="exampleInputEmail1"
                   value="{{  old('alias' )  }}" placeholder="Alias"></div>
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
        <small>{{__('admin.category-description')}}


        </small>
        <input type="hidden" name="type" value="<?php  if ( $group ) {
			echo 'group';
		} else {
			echo 'category';
		} ?>">
    </div>
    <div class="form-group">
        <label for="exampleInputpwd2">{{__('admin.Category Description')}}</label>
        <div class="input-group">
            <div class="input-group-addon"><i class="ti-arrow-right"></i></div>
            <textarea name="description" id="exampleInputpwd2" class="form-control"
                      rows="5">{{  old('description' )  }}</textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="checkbox checkbox-success">
            <input id="checkbox1" type="checkbox">

        </div>
    </div>
    <button type="submit" class="btn btn-block btn-success"><i
                class="fa fa-check"></i>


        {{__('admin.save')}}

    </button>

</form>


