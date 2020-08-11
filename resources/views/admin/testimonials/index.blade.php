@extends('layouts.admin')

@section('title')
List Of Testimonial
@parent
@stop

@section('content')

<section class="content-header">
    <h1>Book </h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">CMS</a>
        </li>
        <li class="active">List Testimonial </li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box primary" style="margin-top: 15px;">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="livicon" data-name="notebook" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Testimonial  Table
                    </div>

                    <div class="pull-right">
                        <a style=" color: white; text-decoration: none !important" href="#addTestimoniModal" data-toggle="modal"><i style="font-size:15px;" class="fa fa-plus"></i>&nbsp; &nbsp;<strong>Add New Testimony</strong></a>
                        <!-- <a style=" color: white; text-decoration: none; margin-right: 20px; !important" href="{{ route('cms.testimonials.create') }}"><i style="font-size:15px;" class="fa fa-plus"></i>&nbsp; &nbsp;<strong>Add New Data</strong></a> -->
                    </div>
                </div>
                
                <div class="portlet-body flip-scroll">
                    <table class="table data-table table-bordered table-striped table-condensed flip-content testimonial" >
                        <thead class="flip-content">
                            <tr>
                                <th class="text-center" width="5%">No</th>
                                <th class="text-center" width="15%">Author</th>
                                <th class="text-center" width="55%">Testimonial</th>
                                <th class="text-center" width="10%">Status</th>
                                <th width="15%">Action</th>
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
                    <center><h4 class="modal-title">Testimony Form</h4></center>
                </div>
                <div class="modal-body">
                    <form class="well form-horizontal" action="{{ route('cms.update-testimony') }}" method="post">  
                        {{ csrf_field() }}
                        <fieldset>
                            <input id="id" name="id" type="hidden">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Name</label>
                                <div class="col-md-9 inputGroupContainer">
                                    <div class="input-group"><span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                    <input id="name_edit" name="name" placeholder="Name" class="form-control" required="true" type="text">
                                </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Testimony</label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                        <textarea rows="8" cols="55" id="desc_edit" name="desc" class="article" required="true">{{old('desc')}}</textarea>
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
                url: "{{ route('cms.testimonials.index') }}", 
              },
              
              columns: [
                  { data: 'DT_RowIndex', name: 'DT_RowIndex', className: "text-center", orderable: false, searchable: false },
                  { data: 'name', name: 'name', className: "text-center" },                  
                  { data: 'desc', name: 'desc', className: "text-center" },                  
                  { data: 'status', name: 'status', className: "text-center" },                  
                  { data: 'action', name: 'action', orderable: false, searchable: false, className: "text-center" },
              ]
          });
          
        });

        $(document).on('click', '.delete-ourProduct', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            var url =   "{{url('backoffice/cms/testimonials/delete/')}}"
            swal({
                    title: "Are you sure ?",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes!",
                    showCancelButton: true,
                },
                function() {
                    $.ajax({
                        type: "POST",
                        url: url +'/'+ id,
                        success: function (data) {
                                window.location.href = "{{ route('cms.testimonials.index') }}";
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
                $('#name_edit').val(data.name);
                $('#desc_edit').val(data.desc);

                $('#btn-save').val("update");
                $('#editTestimoniModal').modal('show');
            }) 
        });
       
      </script>
      
@endsection
