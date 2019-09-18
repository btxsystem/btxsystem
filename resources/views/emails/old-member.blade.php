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
  <h3>Please Login with your account</h3>
  <table>
    <tr>
      <td>Username</td>
      <td>: <strong>{{$data->username}}</strong></td>
    </tr>
      <td>Password</td>
      <td>: <strong>{{$data->password}}</strong></td>
    </tr>
  </table>
  <table>
    <tr>
      <td>Login URL</td>
      <td>: <strong><a href="http://bitrexgo.co.id">http://bitrexgo.co.id</a></strong></td>
    </tr>
  </table>
  <br/>
  <br/>
  <i>Please contact Bitrexgo Customer Service for further information:</i><br/>
  <strong>WA & Telegram</strong> : +62 817-0380-0329<br/>
  Office hour monday - friday (09.00 - 18.00 WIB)
</body>
</html>