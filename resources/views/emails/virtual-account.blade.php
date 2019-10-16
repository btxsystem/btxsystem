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
  <h3 style="text-align:center">BCA Virtual Account Number</h3>
  <h2 style="text-align:center; color:green">{{$data->no_invoice}}</h2>
  <table>
    <tr>
        <td>Amount</td>
        <td>: <strong>{{$data->amount}}</strong></td>
    </tr>
    <tr>
        <td>Description</td>
        <td>: <strong>{{$data->description}}</strong></td>
    </tr>
  </table>
  <br/>
  <br/>
  <i>Please contact Bitrexgo Customer Service for further information:</i><br/>
  <strong>WA & Telegram</strong> : +62 817-0380-0329<br/>
  Office hour monday - friday (09.00 - 18.00 WIB)
</body>
</html>