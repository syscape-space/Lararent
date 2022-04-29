<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="">
                <h2 class="panel-heading">
                 {{__('   Loco Translate / Theme /')}} {{$path ?? ''}}
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



                @if (session('status'))
                    <div class="">
                        <div class="col-md-12">


                            <div class=" alert alert-success">{{ session('status') }}</div>


                        </div>
                    </div>


                @endif

                <div class="col-sm-12">
                    <div class="white-box">
                        <h3 class="box-title">{{__("Change words")}}</h3>
                        <p class="text-muted m-b-20">
                            {{__(' You can translate it or change some words')}}
                        </p>
                        <form action="{{route('admin.translates.theme.store',['slug' =>$path,'lang'=> $request->lang ?? ''])}}" method="post">
                            @csrf

                            @if(getOption('LANG') && $langs = getOption('custom_langs'))
								<?php

								if ( isset( $langs->code ) && isset( $langs->name ) ){
								$langs = array_combine( $langs->code, $langs->name );

								//dump($langs->code);
								?>
                                <div class="entry language">
                                    <div class="title"><b>
                                            @if(isset($langs[App::getLocale()]))
                                                {{ $langs[App::getLocale()]}}
                                            @else
                                                {{App::getLocale()}}
                                            @endif

                                        </b></div>
                                    <label>
                                       {{__(' select the language in which you want to translate the theme')}}
                                        <select onchange="  window.location = '{{route('admin.translates.theme',['slug' =>$path])}}?lang='+ $(this).val();" name="language" class="form-control">

                                            @foreach($langs as $k => $v)

                                                <option <?php  selected($request->lang ?? '',$k); ?>  value="{{$k}}"> {{$v}} </option>


                                            @endforeach

                                        </select>
                                    </label>
                                </div>
								<?php  } ?>
                            @endif
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>{{__("Number")}}</th>
                                        <th>{{__("Key")}}</th>
                                        <th>{{__("Value")}}</th>

                                    </tr>
                                    </thead>
                                    <tbody>

                                    @if($keys ?? false)
                                        @foreach($keys as $k => $v)
                                            <tr style="padding: 0;">
                                                <td style="padding: 3px 15px; font-size: 14px;">
                                                    {{ $loop->iteration}}

                                                </td>
                                                <td style="padding: 3px 15px; font-size: 14px;">
                                                    {{$k}}
                                                    <input type="hidden" name="keys[]" value="{{$k}}">
                                                </td>
                                                <td style="padding: 3px 15px" class="col-md-6"><input
                                                            class="form-control" name="words[]" type="text"
                                                            value="{{$v}}"></td>

                                            </tr>
                                        @endforeach

                                    @endif


                                    </tbody>
                                </table>
                            </div>
                            <button class="btn btn-primary  btn-lg">{{__("Save")}}</button>
                        </form>

                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
