<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container">
    <div class="row">
        <div class="well col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
            <div class="row">
              <div class="col-12">
                <div class="p-4">
                  <h1 class="text-center text-info">Transfer Confirmation</h1>
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
                  @if(!\Session::has('message'))
                  <div class="form-group">
                    @if($select != null)
                      <input type="hidden" name="ebook" value="{{$select}}">
                    @endif
                    <select {{$select != null ? 'disabled' : ''}} class="form-control" name="type" required>
                      @foreach($billTypes as $type)
                        <option value="{{ $type['value'] }}" {{ $type['value'] == $select ? 'selected' : '' }}>{{ $type['title'] }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" name="invoice_number" placeholder="Invoice / Transaction Ref." {{request()->get('ref')  ? 'readonly' : ''}} value="{{request()->get('ref') ?? ''}}"required>
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" name="bank_name" placeholder="Bank Name" value="" required>
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" name="account_name" placeholder="Sender Account Name" value="" required>
                  </div>
                  <div class="form-group">
                    <input type="number" class="form-control" name="account_number" placeholder="Sender Account Number" value="" required>
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" data-type="currency" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" class="amountString" name="amountString" placeholder="Amount" value="" required>
                  </div>
                  <div class="form-group">
                    <input type="hidden" class="form-control" name="amount" id="amount" placeholder="Amount" value="" required>
                  </div>
                  <label for="">Mohon upload bukti transfer anda untuk memudahkan verifikasi</label>
                  <div class="form-group">
                    <input type="file" class="form-control" accept="image/*" name="image">
                  </div>
                  @endif
                  @if(\Session::has('message'))
                    <a type="button" href="{{url('')}}" class="btn btn-success btn-block">
                       Back
                    </a>
                  @else
                    <button type="submit" class="btn btn-success btn-block">
                      Submit
                    </button>
                  @endif
                </form>
            </div>
        </div>
    </div>
<script>
  $(document).ready(function(){
    $("input[data-type='currency']").on({
        keyup: function() {
          $('#amount').val($(this).val().replace(/,/g, ""))
          formatCurrency($(this));
        },
        blur: function() { 
          formatCurrency($(this), "blur");
        }
    });


    function formatNumber(n) {
      // format number 1000000 to 1,234,567
      return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
    }


    function formatCurrency(input, blur) {
      // appends $ to value, validates decimal side
      // and puts cursor back in right position.
      
      // get input value
      var input_val = input.val();
      
      // don't validate empty input
      if (input_val === "") { return; }
      
      // original length
      var original_len = input_val.length;

      // initial caret position 
      var caret_pos = input.prop("selectionStart");
        
      // check for decimal
      if (input_val.indexOf(".") >= 0) {

        // get position of first decimal
        // this prevents multiple decimals from
        // being entered
        var decimal_pos = input_val.indexOf(".");

        // split number by decimal point
        var left_side = input_val.substring(0, decimal_pos);
        var right_side = input_val.substring(decimal_pos);

        // add commas to left side of number
        left_side = formatNumber(left_side);

        // validate right side
        right_side = formatNumber(right_side);
        
        // On blur make sure 2 numbers after decimal
        if (blur === "blur") {
          right_side += "00";
        }
        
        // Limit decimal to only 2 digits
        right_side = right_side.substring(0, 2);

        // join number by .
        input_val = left_side + "." + right_side;

      } else {
        // no decimal entered
        // add commas to number
        // remove all non-digits
        input_val = formatNumber(input_val);
        input_val = input_val;
        
        // final formatting
        if (blur === "blur") {
          input_val;
        }
      }
      
      // send updated string to input
      input.val(input_val);

      // put caret back in the right position
      var updated_len = input_val.length;
      caret_pos = updated_len - original_len + caret_pos;
      input[0].setSelectionRange(caret_pos, caret_pos);
    }
  })
</script>