<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container">
    <div class="row">
        <div class="well col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
            <div class="row">
              <div class="col-12">
                <div class="p-4">
                  <h1 class="text-center text-info">Transaction Summary</h1>
                </div>
                <hr/>
              </div>
            </div>
            <div class="row">
                <!-- <div class="text-center">
                    <h1>Receipt</h1>
                </div> -->
                <div class="col-md-12">
                  @if(\Session::has('message'))
                  <div class="alert alert-success">
                    {!! \Session::get('message') !!}
                  </div>
                  @endif
                  @if(\Session::has('error'))
                  <div class="alert alert-danger">
                    {!! \Session::get('error') !!}
                  </div>
                  @endif
                </div>
                <form action="{{route('payment.confirmation')}}" method="post" enctype="multipart/form-data">
                  {{csrf_field()}}
                  <div class="form-group">
                    <select class="form-control" name="type">
                      <option>Jenis Tagihan</option>
                      <option value="topup_bitrex_point">Topup Bitrex Point</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" name="invoice_number" placeholder="Invoice / Transaction Ref." {{request()->get('ref')  ? 'readonly' : ''}} value="{{request()->get('ref') ?? ''}}"required>
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" name="account_name" placeholder="Account Name" value="" required>
                  </div>
                  <div class="form-group">
                    <input type="number" class="form-control" name="amount" placeholder="Amount" value="" required>
                  </div>
                  <div class="form-group">
                    <input type="number" class="form-control" name="account_number" placeholder="Account Number" value="" required>
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" name="bank_name" placeholder="Bank Name" value="" required>
                  </div>
                  <div class="form-group">
                    <input type="file" class="form-control" name="image">
                  </div>
                  <button type="submit" class="btn btn-danger btn-block">
                    <span class="glyphicon glyphicon-chevron-left"></span> Confirmation Transfer
                  </button>
                </form>
            </div>
        </div>
    </div>
