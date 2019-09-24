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
        <th>No Rek</th>
    </tr>
    </thead>
    <tbody>
    
    @foreach($data as $model)
        <tr>
            <td>{{ $model->id_member }}</td>
            <td>{{ $model->username }}</td>
            <td>{{ $model->no_rec }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>