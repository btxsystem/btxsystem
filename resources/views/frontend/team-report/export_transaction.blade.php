<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document Transaction</title>
</head>
<body>
<table>
    <thead>
    <tr>
        <th>Username</th>
        <th>Ebook</th>
        <th>Transaction Ref</th>
        <th>Expired</th>
        <th>Buy Date</th>
    </tr>
    </thead>
    <tbody>

    @foreach($datas as $model)
        <tr>
            <td>{{ $model->member->username }}</td>
            <td>{{ $model->ebook->title }}</td>
            <td>{{ $model->transaction_ref ?? '-' }}</td>
            <td>{{ $model->expired_at ?? '-' }}</td>
            <td>{{ $model->created_at ?? '-' }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
