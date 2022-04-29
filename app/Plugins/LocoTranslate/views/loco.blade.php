<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="">
                <h2 class="panel-heading">
{{__('Welcome to Loco Translate')}}
                </h2>
                @if (count($errors) > 0)

                    <div class="row">
                        <div class="col-md-12">
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger">{{ $error }}</div>
                            @endforeach

                        </div>

                    </div>
                @endif

                <div class="col-sm-12">
                    <div class="white-box">
                        <h3 class="box-title">{{__("Active theme")}}</h3>
                        <p class="text-muted m-b-20">
                           {{__('You can translate it or change some words')}}
                        </p>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>{{__("Theme name")}}</th>
                                    <th>{{__("Description")}}</th>
                                    <th> {{__('admin.Actions')}}</th>

                                </tr>
                                </thead>
                                <tbody>

                                @if($themes_list ?? false)
                                    @foreach($themes_list as $themes_list_i)

                                        <tr>
                                            <td>
                                                <a href="{{route('admin.translates.theme',['slug' =>$themes_list_i['pathname'] ?? '' ,'lang' => getOption('LANG')])}}">

                                                    {{$themes_list_i['name'] ?? ''}}</a>
                                            </td>
                                            <td>{{$themes_list_i['description'] ?? ''}}</td>
                                            <td class="text-nowrap">
                                                <a href="{{route('admin.translates.theme',['slug' =>$themes_list_i['pathname'] ?? '' ,'lang' => getOption('LANG')])}}" data-toggle="tooltip"
                                                   data-original-title="{{__('admin.Edit')}}"
                                                >
                                                    <i class="fa fa-pencil text-inverse m-r-10"></i>{{__(" ")}}</a>


                                            </td>
                                        </tr>
                                    @endforeach
                                @endif


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="white-box">
                        <h3 class="box-title">{{__("Plugins")}}</h3>
                        <p class="text-muted m-b-20">
                           {{__(' You can translate it or change some words')}}
                        </p>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>{{__("Plugin name")}}</th>
                                    <th>{{__("Description")}}</th>
                                    <th> {{__('admin.Actions')}}</th>

                                </tr>
                                </thead>
                                <tbody>
                                @if($plugins_list ?? false)
                                    @foreach($plugins_list as $plugin_i)

                                        <tr>
                                            <td>
                                                <a href="{{route('admin.translates.plugin',['slug' =>$plugin_i['pathname'] ?? '' ,'lang' => getOption('LANG')])}}">

                                                    {{$plugin_i['name'] ?? ''}}</a>
                                            </td>
                                            <td>{{$plugin_i['description'] ?? ''}}</td>
                                            <td class="text-nowrap">
                                                <a href="{{route('admin.translates.plugin',['slug' =>$plugin_i['pathname'] ?? '' ,'lang' => getOption('LANG')])}}" data-toggle="tooltip"
                                                   data-original-title="{{__('admin.Edit')}}"
                                                >
                                                    <i class="fa fa-pencil text-inverse m-r-10"></i>{{__(" ")}}</a>


                                            </td>
                                        </tr>
                                    @endforeach
                                @endif


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="white-box">
                        <h3 class="box-title"><a href="{{route('admin.translates.admin')}}">{{__("translate Admin area ")}}</a><span class="label label-info m-l-5">{{__("New")}}</span>
                        </h3>
                        <p class="text-muted m-b-20">
                            {{__('You can translate it or change some words')}}
                        </p>

                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
