@extends('layouts.admin')

@section('title')
Claim Reward
@parent
@stop

@section('content')

<section class="content-header">
    <h1>Claim Reward </h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">Claim Reward</a>
        </li>
        <li class="active">Index</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box primary" style="margin-top: 15px;">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="livicon" data-name="notebook" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Claim Reward  Table
                    </div>
<!--
                    <div class="pull-right">
                        <a style=" color: white; text-decoration: none !important" href="#addTestimoniModal" data-toggle="modal"><i style="font-size:15px;" class="fa fa-plus"></i>&nbsp; &nbsp;<strong>Add New Testimony</strong></a>
                    </div> -->
                </div>

                <div class="portlet-body flip-scroll">
                    <table class="table data-table table-bordered table-striped table-condensed flip-content testimonial" >
                        <thead class="flip-content">
                            <tr>
                                <th class="text-center" width="12%">Member ID</th>
                                <th class="text-center" width="15%">Name</th>
                                <th class="text-center" width="15%">Username</th>
                                <th class="text-center" width="25%">Reward</th>
                                <th class="text-center" width="15%">Status</th>
                                <th class="text-center" width="15%">Archive Date</th>
                                <th class="text-center" width="15%">Claim Date</th>
                                <th class="text-center" width="25%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>


<!--section ends-->
<div id="addTestimoniModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <center><h4 class="modal-title">Testimony Form</h4></center>
                </div>
                <div class="modal-body">
                    <form class="well form-horizontal" action="{{ route('cms.testimonials.store') }}" method="post">
                        {{ csrf_field() }}
                        <fieldset>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Name</label>
                                <div class="col-md-9 inputGroupContainer">
                                    <div class="input-group"><span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                    <input id="name" name="name" placeholder="Name" class="form-control" required="true" type="text">
                                </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Testimony</label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                        <textarea rows="8" cols="55" id="desc" name="desc" class="article" required="true">{{old('desc')}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
</div>

<!--section ends-->
<div id="editTestimoniModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <center><h4 class="modal-title">Claim Reward Overview</h4></center>
                </div>
                <div class="modal-body">
                    <form class="well form-horizontal">
                        <fieldset>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Type</label>
                                <div class="col-md-9 inputGroupContainer">
                                    <div class="input-group"><span class="input-group-addon"></span>
                                    <input id="type" name="type" class="form-control" type="text" disabled="true">
                                </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Invoice</label>
                                <div class="col-md-9 inputGroupContainer">
                                    <div class="input-group"><span class="input-group-addon"></span>
                                    <input id="invoice" name="invoice" class="form-control" type="text" disabled="true">
                                </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Status</label>
                                <div class="col-md-9 inputGroupContainer">
                                    <div class="input-group"><span class="input-group-addon"></span>
                                    <input id="status" name="status" class="form-control" type="text" disabled="true">
                                </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Account Name</label>
                                <div class="col-md-9 inputGroupContainer">
                                    <div class="input-group"><span class="input-group-addon"></span>
                                    <input id="account_name" name="account_name" class="form-control" type="text" disabled="true">
                                </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Account Number</label>
                                <div class="col-md-9 inputGroupContainer">
                                    <div class="input-group"><span class="input-group-addon"></span>
                                    <input id="account_number" name="account_number" class="form-control" type="text" disabled="true">
                                </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Bank Name</label>
                                <div class="col-md-9 inputGroupContainer">
                                    <div class="input-group"><span class="input-group-addon"></span>
                                    <input id="bank_name" name="bank_name" class="form-control" type="text" disabled="true">
                                </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Amount</label>
                                <div class="col-md-9 inputGroupContainer">
                                    <div class="input-group"><span class="input-group-addon"></span>
                                    <input id="amount" name="amount" class="form-control" type="text" disabled="true">
                                </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Image</label>
                                <div class="col-md-9 inputGroupContainer">
                                    <span id="image"></span>
                                </div>
                                </div>
                            </div>
<!--
                            <div class="form-group">
                                <label class="col-md-2 control-label">Testimony</label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                        <textarea rows="8" cols="55" id="desc_edit" name="desc" class="article" required="true">{{old('desc')}}</textarea>
                                    </div>
                                </div>
                            </div> -->
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
</div>

@stop

@section('footer_scripts')
    <script type="text/javascript">
        $(document).ready(function () {
          var table = $('.testimonial').DataTable({
              rowCallback: function(row, data, index){
                $(row).find('td').css('vertical-align', 'middle');
              },
              destroy: true,
              processing: true,
              serverSide: true,
              ajax: {
                url: "{{ route('reward-claims.index') }}",
              },

              columns: [
                 // { data: 'DT_RowIndex', name: 'DT_RowIndex', className: "text-center", orderable: false, searchable: false },
                  { data: 'member.id_member', name: 'member.id_member', className: "text-center" },
                  { data: 'fullname', name: 'fullname', className: "text-center", searchable:false, orderable:false  },
                  { data: 'member.username', name: 'member.username', className: "text-center" },
                  { data: 'reward.description', name: 'reward.description', className: "text-center" },
                  { data: 'status_approve', name: 'status_approve', className: "text-center" },
                  { data: 'created_at', name: 'created_at', className: "text-center" },
                  { data: 'updated_at', name: 'updated_at', className: "text-center" },
                  { data: 'action', name: 'action', orderable: false, searchable: false, className: "text-center" },
              ]
          });

        });

        $(document).on('click', '.approve-reward', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            var url =   "{{url('backoffice/reward-claims/approve/')}}"
            swal({
                    title: "Are you sure to approve this reward ?",
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes!",
                    showCancelButton: true,
                },
                function() {
                    $.ajax({
                        type: "GET",
                        url: url +'/'+ id,
                        data: {id:id},
                        success: function (data) {
                                window.location.href = "{{ route('reward-claims.index') }}";
                            }
                    });
            });
        });

        $(document).on('click','.show-reward',function(){
            var id = $(this).data('id');

            var url =   "{{url('backoffice/transfer-confirmation/')}}" +'/'+ id +'/show';

            $.get(url, function (data) {
                //success data
                console.log(BASE_URL +'/'+ data.image);

                $('#type').val(data.type);
                $('#invoice').val(data.invoice_number);
                $('#account_name').val(data.account_name);
                $('#account_number').val(data.account_number);
                $('#bank_name').val(data.bank_name);
                $('#amount').val(convertToRupiah(data.amount));
                $('#status').val(data.status == 0 ? 'Submitted' : 'Approved');
                $('#image').html('<img width="275" height="400" src="' + BASE_URL + '/' +`${data.image}` + '"/>');

                $('#btn-save').val("update");
                $('#editTestimoniModal').modal('show');
            })
        });

        function convertToRupiah(angka)
        {
        	var rupiah = '';
        	var angkarev = angka.toString().split('').reverse().join('');
        	for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
        	return 'Rp. '+rupiah.split('',rupiah.length-1).reverse().join('') + ',-';
        }

      </script>

@endsection
