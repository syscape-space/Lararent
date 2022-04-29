<html>
<head>
    <style type="text/css">
    </style>
</head>
<body>
<table width="550" border="0" cellspacing="0" cellpadding="15">
    <tr bgcolor="#eeffee">
        <td>Order id</td>
        <td>{{$orderId ?? ''}}</td>
    </tr>
    <tr bgcolor="#eeffee">
        <td>Name</td>
        <td>{{$request->name}}</td>
    </tr>
    <tr bgcolor="#eeeeff">
        <td>Email</td>
        <td>{{$request->email}}</td>
    </tr>
    <tr bgcolor="#eeffee">
        <td>Message</td>
        <td>{{$request->message ?? ''}}</td>
    </tr>
    <tr bgcolor="#eeffee">
        <td>Phone</td>
        <td>{{$request->phone ?? ''}}</td>
    </tr>
    <tr bgcolor="#eeeeff">
        <td>Payment options</td>
        <td>{{$request->payment}}</td>
    </tr>
    <tr bgcolor="#eeffee">
        <td><b>Extras</b></td>
		<?php  $ecommerce_cart = Session::get( 'ecommerce_cart' ); ?>

        @if($ecommerce_cart['names']['extras'] ?? false)
            @foreach($ecommerce_cart['names']['extras'] as $item)

                <td>  {{$item['name']}}: {{formatted_price($item['price'])}}</td>

            @endforeach
        @endif
    </tr>
    <tr bgcolor="#eeffee">
        <td><b>Total</b></td>
        <td>{{ formatted_price($ecommerce_cart['total_price'])}}</td>

    </tr>
</table>
</body>
</html>