<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document Member</title>
</head>
<body>
<table>
    <thead>
    <tr>
        <th>ID Member</th>
        <th>Username</th>
        <th>Full Name</th>
        <th>NIK</th>
        <th>Upline Username</th>
        <th>Join date</th>
        <th>Rank</th>
        <th>Expired Member</th>
    </tr>
    </thead>
    <tbody>

    @foreach($datas as $model)
        <tr>
            <td>{{ $model->id_member }}</td>
            <td>{{ $model->username }}</td>
            <td>{{ $model->first_name }}  {{$model->last_name}}</td>
            <td>{{ $model->nik ?? '-' }}</td>
            <td>{{ $model->parent->username ?? '-' }}</td>
            <td>{{ $model->created_at ?? '-' }}</td>
            <td>{{ $model->rank->name ?? '-' }}</td>
            <td>{{ $model->expired_at ?? '-' }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
