<div class="container-fluid">
    <!-- /.row -->


    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    {{   __('admin.Edit Comment') }}


                </div>

                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">

                        <form method="post"
                              action="{{  route('admin.comments.update',['posts'=>$comment->id])  }}">

                            @if(isset($comment->id))
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

                                <div class="col-md-9">
                                    <h3 class="box-title">{{__('admin.About Comment')}}</h3>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="">
                                                <div class="form-group">
                                                    <label class="control-label"> {{__('admin.Name')}}</label>
                                                    <input type="text" id="firstName" class="form-control"
                                                           name="name" placeholder="{{__('admin.Name')}}"

                                                           value="{{  old('name', isset($comment->name) ? $comment->name : '' )  }}"
                                                    ></div>
                                            </div>
                                            <!--/span-->
                                            <div class="">
                                                <div class="">
                                                    <label class="control-label"> {{__('admin.URL')}}

                                                    </label>

                                                </div>
                                                <input name="site" type="text" id="site" class="form-control"
                                                       placeholder=""
                                                       value="{{  old('site', isset($comment->site) ? $comment->site : '' )  }}"

                                                >
                                            </div>
                                            <div class="">
                                                <div class="">
                                                    <label class="control-label"> {{__('admin.Email')}}


                                                    </label>

                                                </div>
                                                <input name="email" type="text" id="email" class="form-control"
                                                       placeholder=""
                                                       value="{{  old('alias', isset($comment->email) ? $comment->email : '' )  }}"

                                                >
                                            </div>
                                            <br>
                                            <div class="alert alert-info">

                                             {{__('In response to:')}} <a href="{{  route('admin.posts.edit',['post'=>$comment->post->id])  }}"
                                                                          class="text-white">{{$comment->post->title}}</a>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <h3 class="box-title"> {{__('admin.Comment')}}</h3>
                                            <div class="row">
                                                <div class="col-md-12 ">

                                                    <div class="form-group  text-editor-full">
                                                    <textarea name="text" class="text form-control"
                                                              rows="4">{{  old('text', isset($comment->text) ? $comment->text : '' )  }}</textarea>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>


                                        <!--/span-->
                                    </div>








                                </div>
                                <!--->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label for="scheduled_publication" class="control-label"><strong>
                                                    {{__('Status')}}

                                                </strong> </label>

                                            <select class="form-control col-md-12" name="status">
                                                <option  {{selected('published',$comment->status)}} value="published"> {{__('Approved')}}</option>
                                                <option {{selected('pending',$comment->status)}} value="pending"> {{__('Pending')}}</option>
                                                <option {{selected('spam',$comment->status)}} value="spam"> {{__('Spam')}}</option>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="clearfix ">
                                        <div class="form-actions m-t-40">
                                            <button type="submit" class="btn btn-block btn-success btn-lg"><i
                                                        class="fa fa-check"></i>

                                                @if(isset($comment->id) )

                                                    {{__('admin.update')}}
                                                @else

                                                    {{__('admin.save')}}
                                                @endif
                                            </button>

                                        </div>
                                        <br><br>
                                    </div>

                                </div>


                                <!--/row-->


                                <!--/row-->

                                <hr>
                            </div>
                            {{ csrf_field()  }}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
