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
                  <h1 class="text-center text-success">Transaction Successful</h1>
                </div>
                <hr/>
              </div>
            </div>
            <div class="row">
                <!-- <div class="text-center">
                    <h1>Receipt</h1>
                </div> -->
                </span>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th colspan=2>Product</th>
                            <th colspan=2>Transaction Ref.</th>
                         </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan=2>{{ $prodDesc ?? '' }}</h4></td>
                            <td colspan=2> {{ $code ?? '' }} </td>
                        </tr>

                    </tbody>
                </table>
                <a type="button" href="{{route('member.dashboard')}}" class="btn btn-success btn-lg btn-block">
                  Back to Dashboard
                </a></td>
            </div>
        </div>
    </div>
