<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact US</title>
</head>
<body>
  Dear Team CS, <br/><br/>
  Terdapat pesan baru sebagai berikut :<br/><br/>
  Pengirim : {{ $data['name'] }}<br/>
  Email : {{ $data['email'] }}<br/>
  Pesan : {{ $data['message'] }}<br/>
  Tanggal & Waktu : {{ $data['created_at'] }}<br/><br/>
  Untuk melihat pesan lainnya, dapat dilihat di Backoffice.
</body>
</html>