<div class="container-fluid">
    <!-- row -->

    <!--/.row -->
    <!-- /row -->
    @if(isset($order->id))
        <form action="{{route('admin.products.orders.update',['orders' => $order->id])}}" method="post">
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
            <div class="row">

                <div class="col-md-12 col-xs-12">
                    <div class="white-box">
                        <h2 class=""><b>{{__('Order')}} #{{$order->id }}  {{__('details')}} </b></h2>
                        <div class="row">

                            <div class="col-md-6">
                                <h4 class="box-title">{{__('General')}}</h4>
                                <div class="form-body">

                                    <div class="form-group">
                                        <p class="woocommerce-order-data__meta order_number">
                                            {{__('Payment via')}} <b>{{$order->payment ?? ''}}</b>
                                            . {{__('Customer IP:')}}
                                            <span
                                                    class="Order-customerIP">{{$order->ip}}</span>
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputUsers">{{__('Date created')}}</label>
                                        <input name="name" type="text" required="" class="form-control"
                                               id="exampleInputUsers" value="{{$order->created_at ?? ''}}"
                                               placeholder="Enter Username">
                                    </div>


                                    <div class="form-group">

                                        <label for="exampleInputEmail1">{{__('Status:')}}</label>
                                        


                                        <select class="form-control" name="status" id="status">
                                            <option

												<?php  if( 'pending' ==  $order->status ){ echo 'selected="selected"';} ?>  value="pending">{{__('pending')}}</option>
                                            <option
	                                            <?php  if( 'processing' ==  $order->status ){ echo 'selected="selected"';} ?>
											 value="processing">{{__('Processing')}}</option>
                                            <option
	                                            <?php  if( 'paid' ==  $order->status ){ echo 'selected="selected"';} ?>
												 value="paid">{{__('paid')}}</option>

                                            <option
	                                            <?php  if( 'canceled' ==  $order->status ){ echo 'selected="selected"';} ?>
		                                         value="canceled">{{__('canceled')}}
                                            </option>
                                            <option
	                                            <?php  if( 'completed' ==  $order->status ){ echo 'selected="selected"';} ?>
											  value="completed">{{__('completed')}}
                                            </option>


                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{{__('Customer Message')}}</label>

                                        <p>{{$order->message ?? ''}}</p>
                                    </div>


                                </div>
                            </div>
                            <div class="col-md-6">

                                <h4 class="box-title">{{__('Customer info')}}</h4>
                                <div class="form-body">
                                    <div class="form-group">
                                        <label for="exampleInputUsers">{{__('Customer Name')}}</label>
                                        <input name="name" type="text" required="" class="form-control"
                                               id="exampleInputUsers" value="{{$order->name}}"
                                               placeholder="{{__('Enter Username')}}">
                                    </div>


                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{{__('Customer Email address')}}</label>
                                        <input name="email" value="{{$order->email}}" type="email" required=""
                                               class="form-control" id="exampleInputEmail1">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{{__('Customer phone')}}</label>
                                        <input name="phone" value="{{$order->phone}}" type="text" required=""
                                               class="form-control" id="exampleInputEmail1" placeholder="">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{{__('Customer Street address')}}</label>
                                        <input name="street_address" value="{{$order->street_address}}" type="text" required=""
                                               class="form-control" id="exampleInputEmail1">
                                    </div>


                                </div>
                            </div>


                        </div>
                        <hr>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <div class="white-box">
                        <h2 class=""><b>{{__('Order items')}}</b></h2>
                        <div class="table-responsive">

                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>{{__('item')}}</th>
                                    <th></th>
                                    <th>{{__('Cost')}}</th>
                                    <th>{{__('Quantity')}}</th>
                                    <th>{{__('Total')}}</th>
                                    <th>{{__('admin.Actions')}}</th>
                                </tr>
                                </thead>
                                <tbody>
								<?php  $total_order = 0; ?>
                                @if($order->items)
                                    @foreach($order->items as $item)
                                        <tr>
                                            <td class="col-md-1">
                                                @if($item->product->img ?? false && the_image_url($item->product->img,'thumbnail-70x70') )
                                                    <img class="" style="margin-right: 10px;"
                                                         src="{{the_image_url($item->product->img,'thumbnail-70x70')}}"
                                                         alt="{{$item->product->title}}" width="80">
                                                @endif


                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <a href="{{route('admin.products.edit',['product' => $order->items->first()->product->id])}}">
                                                        {{$item->product->title}}
                                                    </a>
                                                </div>
                                                <div class="clearfix"></div>

                                                <table class="col-md-7 ">

                                                    <tbody>


                                                    @foreach($item->meta as $meta)
                                                        @if($meta->key == 'PickingUpDate' || $meta->key == 'DroppingOffDate')
                                                            <tr>
                                                                <th>{{$meta->title ?? ''}}</th>
                                                                <td>
                                                                    <p>{{ $meta->value }}</p>
                                                                </td>
                                                            </tr>
                                                        @elseif($meta->key == 'extras')

                                                            <tr>
                                                                <th>{{__('Extras')}}<br></th>
                                                                <td>@foreach (unserialize($meta->value ) as $e)
                                                                        {{$e}} <br>
                                                                    @endforeach
                                                                    <br>
                                                                </td>
                                                            </tr>
                                                        @elseif($meta->key !== '')
                                                            <tr>
                                                                <th>{{$meta->title ?? ''}}</th>
                                                                <td><p>{{$meta->value ?? ''}}</p>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach


                                                    </tbody>
                                                </table>
                                            </td>
                                            <td>{{$item->price}}</td>
                                            <td>{{$item->quantity}}</td>
                                            <td class="font-500">{{$item->price}}</td>
                                            <td><a href="javascript:void(0)" class="text-inverse"
                                                   title="Delete" data-toggle="tooltip"><i
                                                            class="ti-trash"></i></a></td>
                                        </tr>
										<?php  $total_order += ( $item->quantity * $item->price ) ?>
                                    @endforeach
                                @endif


                                <tr>
                                    <td colspan="5" class="font-500" align="right">{{__('Total')}}</td>
                                    <td class="font-500">{{$total_order}}</td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="font-bold text-dark" align="right">
                                        {{__('Payable Amount')}}
                                    </td>
                                    <td class="font-bold text-dark"> {{$total_order}}</td>
                                </tr>
                                </tbody>
                            </table>

                            <hr>
                            <div class="form-actions m-t-40">
                                <button type="submit" class="btn btn-block btn-success btn-lg"><i
                                            class="fa fa-check"></i>
                                    {{__('update')}}
                                </button>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <!-- ===== Right-Sidebar-End ===== -->
            </div>
        </form>
    @endif

</div>