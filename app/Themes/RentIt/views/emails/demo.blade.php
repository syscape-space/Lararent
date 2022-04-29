<html>
<head>
    <style type="text/css">
    </style>
</head>
<body>
<table width="550" border="0" cellspacing="0" cellpadding="15">
    <tr bgcolor="#eeffee">
        <td>{{__('Name')}}</td>
        <td>{{$request->name ?? ''}}</td>
    </tr>
    <tr bgcolor="#eeeeff">
        <td>{{__('Email')}}</td>
        <td>{{$request->email ?? ''}}</td>
    </tr>
    <tr bgcolor="#eeeeff">
        <td>   {{__('Subject')}}</td>
        <td>{{$request->subject ?? ''}}</td>
    </tr>
    <tr bgcolor="#eeffee">
        <td>{{__('Message')}}</td>
        <td>{{$request->message ?? ''}}</td>
    </tr>
</table>
</body>
</html>