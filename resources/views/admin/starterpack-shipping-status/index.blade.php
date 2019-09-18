@extends('layouts.admin')

@section('title')
List Of Starterpack Shipping
@parent
@stop

@section('content')

<section class="content-header">
    <h1>Starterpack Shipping Undelivered </h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">Starterpack Shipping</a>
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
                        Starterpack Shipping  Table
                    </div>
                </div>
                
                <div class="portlet-body flip-scroll">
                    <table class="table data-table table-bordered table-striped table-condensed flip-content testimonial" >
                        <thead class="flip-content">
                            <tr>
                                <th class="text-center" width="5%">No</th>
                                <th class="text-center" width="20%">Username</th>
                                <th class="text-center" width="25%">Address</th>
                                <th class="text-center" width="25%">Invoice</th>
                                <th class="text-center" width="15%">Phone</th>
                                <th width="10%">Action</th>
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
<div id="editTestimoniModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <center><h4 class="modal-title">Deliver Startepack</h4></center>
                </div>
                <div class="modal-body">
                    <form class="well form-horizontal" action="{{ route('starterpack-shipping.deliver.starterpack') }}" method="post">  
                        {{ csrf_field() }}
                        <fieldset>
                            <input id="id" name="id" type="hidden">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Waybill</label>
                                <div class="col-md-9 inputGroupContainer">
                                    <div class="input-group"><span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                    <input id="waybill" name="waybill" placeholder="Input waybill here" class="form-control" required="true" type="text">
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
                url: "{{ route('starterpack-shipping.index') }}", 
              },
              
              columns: [
                  { data: 'DT_RowIndex', name: 'DT_RowIndex', className: "text-center", orderable: false, searchable: false },
                  { data: 'username', name: 'employeers.username', className: "text-center" },                  
                  { data: 'address', name: 'address', className: "text-center" },                  
                  { data: 'invoice', name: 'invoice', className: "text-center" },                  
                  { data: 'phone', name: 'employeers.phone_number', className: "text-center" },                  
                  { data: 'action', name: 'action', orderable: false, searchable: false, className: "text-center" },
              ]
          });
          
        });

        $(document).on('click', '.delete-ourProduct', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            var url =   "{{url('backoffice/cms/our-products/')}}"
            swal({
                    title: "Are you sure ?",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes!",
                    showCancelButton: true,
                },
                function() {
                    $.ajax({
                        type: "DELETE",
                        url: url +'/'+ id,
                        data: {id:id},
                        success: function (data) {
                                window.location.href = "{{ route('cms.our-products.index') }}";
                            }         
                    });
            });
        });

        $(document).on('click', '.publish-testimonial', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            var url =   "{{url('backoffice/cms/testimonials/published/')}}"
            swal({
                    title: "Are you sure to publish this data ?",
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
                                window.location.href = "{{ route('cms.testimonials.index') }}";
                            }         
                    });
            });
        });

        $(document).on('click', '.unpublish-testimonial', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            var url =   "{{url('backoffice/cms/testimonials/unpublished/')}}"
            swal({
                    title: "Are you sure to unpublish this data ?",
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
                                window.location.href = "{{ route('cms.testimonials.index') }}";
                            }         
                    });
            });
        });


        $(document).on('click','.edit-testimonial',function(){
   
            var id = $(this).data('id');
            
            var url =   "{{url('backoffice/cms/testimonials/')}}" +'/'+ id +'/edit';
            // console.log('Image')
            console.log(url)

            $.get(url, function (data) {
                //success data
                $('#id').val(data.id);
                // $('#name_edit').val(data.name);
                // $('#desc_edit').val(data.desc);

                $('#btn-save').val("update");
                $('#editTestimoniModal').modal('show');
            }) 
        });
       
      </script>
      
@endsection
