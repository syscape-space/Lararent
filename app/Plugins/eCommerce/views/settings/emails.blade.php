<table class="table table-striped" id="myTable">
    <thead>
    <tr>
        <th></th>
        <th>{{__('Email')}}</th>
        <th>{{__('	Recipient(s)')}}</th>
        <th></th>
    </tr>
    </thead>
    <tbody>



    @foreach($gateways as $gateway)
        <tr>

            <td><i class="icon-screen-desktop fa-fw"></i></td>
            <td>{{$gateway->method_title}}</td>
            <td>{{$gateway->recipients ?? '' }}</td>

            <td><a href="{{ route('admin.ecommerce.email.edit',['email' => $gateway->id]) }}"
                   class="btn btn-block btn-success">{{__('Edit')}}</a></td>
        </tr>

    @endforeach


    </tbody>
</table>