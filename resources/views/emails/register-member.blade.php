<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <style>
  table {
    /* border: 1px solid #ccc; */
    border-collapse: collapse;
    margin: 0;
    padding: 0;
    width: 100%;
    table-layout: fixed;
  }

  table caption {
    font-size: 1.5em;
    margin: .5em 0 .75em;
  }

  table tr {
    padding: 5em;
  }


  table th {
    font-size: .85em;
    letter-spacing: .1em;
    text-transform: uppercase;
  } 

  table td {
    padding-top: 10px;
    padding-bottom:10px;
  }
  </style>
</head>
<body>
  <h1 style="text-align:center">WELCOME TO BITREXGO</h1>
  <h3>PERSONAL DATA</h3>
  <table>
    <tr>
      <td>First Name</td>
      <td>: <strong>{{$data->member->first_name}}</strong></td>
    </tr>
    <tr>
      <td>Last Name</td>
      <td>: <strong>{{$data->member->last_name}}</strong></td>
    </tr>
    <tr>
      <td>Username</td>
      <td>: <strong>{{$data->member->username}}</strong></td>
    </tr>
    <tr>
      <td>Email</td>
      <td>: <strong>{{$data->member->email}}</strong></td>
    </tr>
    <tr>
      <td>Password</td>
      <td>: <strong>{{$data->password}}</strong></td>
    </tr>
    <tr>
      <td>Phone</td>
      <td>: <strong>{{$data->member->phone_number}}</strong></td>
    </tr>
  </table>
  @if($additional != null)
  <h3>EBOOK ACCESS</h3>
  <table>
    <tr>
      <td>Username</td>
      <td>: <strong>{{$data->member->username}}</strong></td>
    </tr>
    <tr>
      <td>Password</td>
      <td>: <strong>{{$data->password}}</strong></td>
    </tr>
    <!-- <tr>
      <td>Ebook Type</td>
      <td>: <strong>{{ucwords(str_replace("_", " ", $data->ebook->title))}}</strong></td>
    </tr> -->
    <tr>
      <td>Login URL</td>
      <td>: <strong><a href="http://ebook.bitrexgo.id/ebook">http://ebook.bitrexgo.id/ebook</a></strong></td>
    </tr>
  </table>  
  @endif
  <br/>
  <br/>
  <i>Please contact Bitrexgo Customer Service for further information:</i><br/>
  <strong>WA & Telegram</strong> : +62 817-0380-0329<br/>
  Office hour monday - friday (09.00 - 18.00 WIB)
</body>
</html>