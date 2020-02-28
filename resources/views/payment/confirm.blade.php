<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
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
                  <div id="message"></div>
                </div>
                <form action="{{route('payment.confirmation')}}" method="post" enctype="multipart/form-data" id="form">
                  {{csrf_field()}}
                  @if(!\Session::has('message'))
                  <div class="form-group">
                    @if($select != null)
                      <input type="hidden" name="ebook" value="{{$select}}">
                      <input type="hidden" name="token" value="{{csrf_token()}}">
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
                    <input type="number" class="form-control" name="amount" id="amount" placeholder="Amount" value="" required>
                  </div>
                  <label for="">Mohon upload bukti transfer anda untuk memudahkan verifikasi</label>
                  <div class="form-group">
                    <input type="file" class="form-control" accept="image/*" name="image" id="fileinput">
                  </div>
                  <img id="source_image" class="hidden" style="width:100%">
                  <img id="compressed_image" class="hidden" style="width:100%">
                  @endif
                  <a type="button" href="{{url('')}}" class="btn btn-success btn-block hidden" id="back-btn">
                      Back
                  </a>
                  @if(\Session::has('message'))
                    
                  @else
                    <button type="submit" class="btn btn-success btn-block" id="submit-btn">
                      Submit
                    </button>
                  @endif
                </form>
            </div>
        </div>
    </div>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="{{asset('assets3/js/jquery.loading.min.js')}}"></script>
<script src="{{asset('assets3/js/JIC.js')}}"></script>
<script>
var output_format = null;
var file_name = null;
var resultFile;

function dataURLtoFile(dataurl, filename) {
 
 var arr = dataurl.split(','),
     mime = arr[0].match(/:(.*?);/)[1],
     bstr = atob(arr[1]), 
     n = bstr.length, 
     u8arr = new Uint8Array(n);
     
 while(n--){
     u8arr[n] = bstr.charCodeAt(n);
 }
 
 return new File([u8arr], filename, {type:mime});
}

function readFile(evt) {
  $(".container").loading();

  var file = evt.target.files[0];
  var reader = new FileReader();
    reader.onload = function(event) {
    var i = document.getElementById("source_image");
            i.src = event.target.result;
            i.onload = function(){
            }
    };
  output_format = file.name.split(".").pop();
  file_name = file.name;
  reader.readAsDataURL(file);

  var quality = 30;
  var source_image = document.getElementById("source_image");

  var compressed_image = document.getElementById("compressed_image");
  setTimeout(() => {
    compressed_image.src = jic.compress(source_image,quality,output_format).src;

    resultFile = dataURLtoFile(compressed_image.src,'image.png');
    $(".container").loading('stop');
  }, 100)
  return false;
}

function submitData () {
  $(".container").loading();

  $('#message').html('')
  let formData = new FormData();
  formData.append('image', resultFile)
  formData.append('ebook', $("input[name='ebook']").val())
  formData.append('type', $("select[name='type']").val())
  formData.append('invoice_number', $("input[name='invoice_number']").val())
  formData.append('bank_name', $("input[name='bank_name']").val())
  formData.append('account_name', $("input[name='account_name']").val())
  formData.append('account_number', $("input[name='account_number']").val())
  formData.append('amount', $("input[name='amount']").val())
  formData.append('_token', $("input[name='token']").val())

  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
    }
  });

  $.ajax({
    url: "{{route('payment.confirmation')}}",
    processData: false,
    contentType: false,
    data: formData,
    type: 'POST',
    success: function(data){    
      $(".container").loading('stop');

      if(!data.success) {
        $(`#message`).html(`
          <div class="alert alert-danger">
            ${data.message}
          </div>
        `)

        return;
      }

      $(`#message`).html(`
        <div class="alert alert-success">
          ${data.message}
        </div>
      `)

      window.location.href = "{{url('/)}}"
    }
  })
}

$('#form').submit(function(e) {
  e.preventDefault()
  submitData()
})

document.getElementById("fileinput").addEventListener("change", readFile, false);
</script>