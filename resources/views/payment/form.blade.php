<html>
<body>

<form method="post" id="payment" name="ePayment" action="{{env('IPAY_POST') ?? 'https://sandbox.ipay88.co.id/epayment/entry.asp'}}">
<input type="hidden" name="MerchantCode" value="{{$data['merchant_code']}}">
<!-- <input type="hidden" name="PaymentId" value="{{$data['payment_id']}}"> -->
<input type="hidden" name="RefNo" value="{{$data['ref_no']}}">
<input type="hidden" name="Amount" value="{{$data['amount']}}">
<input type="hidden" name="Currency" value="IDR">
<input type="hidden" name="ProdDesc" value="{{$data['product_desc']}}">
<input type="hidden" name="UserName" value="{{$data['user_name']}}">
<input type="hidden" name="UserEmail" value="{{$data['user_email']}}">
<input type="hidden" name="UserContact" value="0126500100">
<input type="hidden" name="Remark" value="">
<input type="hidden" name="Lang" value="UTF-8">
<input type="hidden" name="Signature" value="{{$data['signature']}}">
<input type="hidden" name="ResponseURL" value="{{$data['response_url']}}">
<input type="hidden" name="BackendURL" value="{{$data['backend_url']}}">
</form>
<script>
let form = document.getElementById('payment')
form.submit()
</script>
</body>
</html>