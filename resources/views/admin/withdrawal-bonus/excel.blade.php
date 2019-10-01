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
        <th>ID Member</th>
        <th>Username</th>
        <th>Full Name</th>
        <th>No Rek</th>
        <th>Acount Bank Name</th>
        <th>Bank Name</th>
        <th>Tax</th>
        <th>Total</th>
    </tr>
    </thead>
    <tbody>
    
    @foreach($datas as $model)
        <tr>
            <td>{{ $model->id_member }}</td>
            <td>{{ $model->username }}</td>
            <td>{{ $model->first_name }}  {{$model->last_name}}</td>
            <td>{{ $model->no_rec }}</td>
            <td>{{ $model->bank_account_number }}</td>
            <td>{{ $model->bank_name }}</td>
            <td>{{ $model->verification == 1 ? '3.0%' : '2.5%' }}</td>
            <td>{{ currency($model->total_bonus) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>