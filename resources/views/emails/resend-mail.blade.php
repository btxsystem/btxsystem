<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  Hi, <strong>{{$data->first_name}} {{$data->last_name}}</strong><br/><br/>
  Akun anda telah diperbaharui, untuk kenyamanan anda mohon untuk memperbaharui password anda pada dashboard member Bitrexgo :
  <br/>
  <strong>{{$data->email}} </strong>
  <br/>
  Password Login : <strong>bitrexgo123</strong>
</body>
</html>
