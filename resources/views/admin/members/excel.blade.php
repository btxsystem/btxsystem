<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<table>
    <thead>
    <tr>
        <th>id</th>
        <th>id_member</th>
        <th>username</th>
        <th>first_name</th>
        <th>last_name</th>
        <th>email</th>
        <th>password</th>
        <th>birthdate</th>
        <th>npwp_number</th>
        <th>is_married</th>
        <th>gender</th>
        <th>status</th>
        <th>phone_number</th>
        <th>no_rec</th>
        <th>bank_account_number</th>
        <th>bank_name</th>
        <th>bank_account_name</th>
        <th>position</th>
        <th>parent_id</th>
        <th>sponsor_id</th>
        <th>rank_id</th>
        <th>created_at</th>
        <th>updated_at</th>
        <th>verification</th>
        <th>bitrex_cash</th>
        <th>bitrex_points</th>
        <th>pv</th>
        <th>src</th>
        <th>is_update</th>
        <th>nik</th>
        <th>expired_at</th>

    </tr>
    </thead>
    <tbody>
    @foreach($datas as $data)
    <tr>
        <td>{{$data->id}}</td>
        <td>{{$data->id_member}}</td>
        <td>{{strtolower($data->username)}}</td>
        <td>{{ucwords("$data->first_name")}}</td>
        <td>{{ucwords("$data->last_name")}}</td>
        <td>{{$data->email}}</td>
        <td>{{$data->password}}</td>
        <td>{{$data->birthdate}}</td>
        <td>'{{$data->npwp_number}}</td>
        <td>
            @if($data->is_married==0)
                {{"single"}}
            @else
                {{"married"}}
            @endif
        </td>
        <td>
            @if($data->gender==0)
                {{"male"}}
            @else
                {{"female"}}
            @endif
        </td>
        <td>
            @if($data->status==0)
                {{"nonactive"}}
            @else
                {{"active"}}
            @endif
        </td>
        <td>'{{$data->phone_number}}</td>
        <td>'{{$data->no_rec}}</td>
        <td>{{$data->bank_account_number}}</td>
        <td>{{$data->bank_name}}</td>
        <td>{{$data->bank_account_name}}</td>
        <td>
            @if($data->position==0)
                {{"left"}}
            @elseif($data->position==1)
                {{"midle"}}
            @else
                {{"right"}}
            @endif
        </td>
        <td>{{$data->parent_id}}</td>
        <td>{{$data->sponsor_id}}</td>
        <td>{{$data->rank_id}}</td>
        <td>{{$data->created_at}}</td>
        <td>{{$data->updated_at}}</td>
        <td>{{$data->verification}}</td>
        <td>{{$data->bitrex_cash}}</td>
        <td>{{$data->bitrex_points}}</td>
        <td>{{$data->pv}}</td>
        <td>{{$data->src}}</td>
        <td>{{$data->is_update}}</td>
        <td>{{$data->nik}}</td>
        <td>{{$data->expired_at}}</td>
    </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>