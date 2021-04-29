<html>
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <style type="text/css">
      @import url('https://fonts.googleapis.com/css?family=Roboto');
      .container {
        padding:20px;
        background-color:#EFEFEF;
        font-family: sans-serif;
        line-height:1.5em;
      }
      .row {
        padding:30px;
        background-color:white;
      }
      .logo-wrapper {
        padding:10px;
        margin-bottom:20px;
        text-align:center;
      }

      .logo-wrapper img {
        height:200px;
      }
      .email-footer {
        margin-top:50px;
        width:100%;
        display:table;
      }
      .email-row {
        width:100%;
        display:table;
      }
      .email-row > div {
        display:table-cell;
        width:50%;
      }
      .email-row > div {
        display:inline-flex;
        width:90vw;
      }
      .email-footer > div {
        display:table-cell;
        width:50%;
      }
      .footer-notes {
        font-size:10px;
        text-align:justify;
        margin-top:20px;
      }
      .socmed-wrapper a.btn {
        text-decoration:none;
        color:white;
        padding:10px 30px;
        border-radius: 100px;
        background-color:#FAB702;
      }
      .socmed-wrapper a.icn img {
        height:20px;
      }
      .socmed-wrapper a.icn span {
        color:black;
        margin-left:10px;
      }
      .socmed-wrapper a.icn {
        text-decoration:none;
        padding-left:20px;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="logo-wrapper">
          <img src="https://bitrexgo.co.id/img/logo.png"/>
        </div>
        <div>
          <h2 style="text-align:center;">PAIRING NOTIFICATION REWARD</h2>
        </div>
        <div class="email-ct">
          <p>Dear, {{ $data->username }}</p>
          <p>
          Anda telah mendapatkan Komisi Pairing {{ $data->nominal }}. Tingkatkan terus aktivitas anda di Bitrexgo untuk mendapatkan reward selanjutnya.
          </p>
          <br>
          <br>
          <p>
          Sincerely,
          </p>
          <p>
          Bitrexgo Support
          </p>
          <br>
        </div>
        <hr>
        <div class="email-footer">
          <i>Please contact Bitrexgo Customer Service for further information:</i><br/>
          <strong>WA & Telegram</strong> : +62 817-0380-0329<br/>
          Office hour monday - friday (09.00 - 18.00 WIB)
        </div>
      </div>
    </div>
  </body>
</html>

