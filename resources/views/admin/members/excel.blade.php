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
        <th>Email</th>
        <th>Birthdate</th>
        <th>Npwp Number</th>
        <th>Is Married</th>
        <th>Gender</th>
        <th>Status</th>
        <th>Phone Number</th>
        <th>No Rek</th>
        <th>Bank Account Name</th>
        <th>Bank Account Number</th>
        <th>Position</th>
        <th>Parent</th>
        <th>Sponsor</th>
        <th>Rank Id</th>
        <th>Created Date</th>
        <th>Updated Date</th>
        <th>Verification</th>
        <th>Bitrex Cash</th>
        <th>Bitrex Points</th>
        <th>Pv</th>
        <th>Src</th>
        <th>Is Update</th>
        <th>Nik</th>
        <th>Expired Date</th>
    </tr>
    </thead>
    <tbody>
    @foreach($datas as $data)
    <tr>
        <td>{{$data->id_member}}</td>
        <td>{{$data->username}}</td>
        <td>{{ucwords("$data->first_name").' '.ucwords("$data->last_name")}}</td>
        <td>{{$data->email}}</td>
        <td>{{$data->birthdate}}</td>
        <td>{{$data->npwp_number}}</td>
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
        <td>{{$data->phone_number}}</td>
        <td>{{$data->no_rec}}</td>
        <td>{{$data->bank_account_name}}</td>
        <td>{{$data->bank_account_number}}</td>
        <td>
            @if($data->position==0)
                {{"left"}}
            @elseif($data->position==1)
                {{"midle"}}
            @else
                {{"right"}}
            @endif
        </td>
        <td>{{$data->parent}}</td>
        <td>{{$data->sponsor}}</td>
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