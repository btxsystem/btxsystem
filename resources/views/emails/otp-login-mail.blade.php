<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>OTP</title>
</head>
<body>
  Hi, Admin
  <br/>
  <br/>
  Berikut adalah kode OTP terbaru untuk akun {{ $data->email }} dengan IP Address : {{ $data->ip_address }}
  <br/>
  Kode OTP: <strong>{{ $data->code }}</strong>
  <br/>
  <br/>
  Request From<br/>
  IP Address : {{ $data->ip_address }}<br/>
  User Agent : {{ $data->user_agent }}<br/>
  Time: {{ date('Y-m-d H:i:s') }}
</body>
</html>