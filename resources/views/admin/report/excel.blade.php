<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<table>
    <thead>
    <tr>
        <th>Transaction No</th>
        <th>Name</th>
        <th>Username</th>
        <th>Contact</th>
        <th>Address</th>
        <th>Get Startepack</th>
        <th>Product</th>
        <th>Price</th>
        <th>Buy Date</th>
        <th>Expired</th>
        <th>Curir</th>
        <th>Cost</th>
    </tr>
    </thead>
    <tbody>
    
    @foreach($data as $model)
        <tr>
            <td>{{ $model->transaction_ref }}</td>
            <td>{{ $model->member ? $model->member->first_name .' '. $model->member->last_name : '' }}</td>
            <td>{{ optional($model->member)->username }}</td>
            <td>{{ optional($model->member)->phone_number }}</td>
            <td>{{ $model->member->address ? $model->member->address->province .', '. $model->member->address->city_name .', '. $model->member->address->subdistrict_name .', '. $model->member->address->decription : '-' }}</td>
            <td>{{ $model->member->address ? 'Shipping' : 'Take Away' }}</td>
            <td>{{ optional($model->ebook)->title }}</td>
            <td>{{ optional($model->ebook)->price }}</td>
            <td>{{ $model->created_at }}</td>
            <td>{{ $model->expired_at }}</td>
            <td>{{ $model->member->address ? $model->member->address->kurir : '-' }}</td>
            <td>{{ $model->member->address ? $model->member->address->cost : '-' }}</td>

        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>