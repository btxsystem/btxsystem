@extends('layouts.admin')

@section('title')
List Of About US
@parent
@stop

@section('content')

<section class="content-header">
    <h1>About Us</h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">CMS</a>
        </li>
        <li class="active">List About US </li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box primary" style="margin-top: 15px;">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="livicon" data-name="notebook" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        About US  Table
                    </div>

                    <div class="pull-right">
                        <a style=" color: white; text-decoration: none !important" href="#addAboutModal" data-toggle="modal"><i style="font-size:15px;" class="fa fa-plus"></i>&nbsp; &nbsp;<strong>Add New Data</strong></a>
                    </div>
                </div>
                
                <div class="portlet-body flip-scroll">
                    <table class="table data-table table-bordered table-striped table-condensed flip-content about-us" >
                        <thead class="flip-content">
                            <tr>
                                <th class="text-center" width="5%">No</th>
                                <th class="text-center" width="15%">Title</th>
                                <th class="text-center" width="45%">Description</th>
                                <th class="text-center" width="10%">Image</th>
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
<div id="addAboutModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <center><h4 class="modal-title">About Us Form</h4></center>
                </div>
                <div class="modal-body">
                    <form class="well form-horizontal" action="{{ route('cms.about-us.store') }}" method="post" enctype="multipart/form-data">  
                        {{ csrf_field() }}
                        <fieldset>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Title</label>
                                <div class="col-md-9 inputGroupContainer">
                                    <div class="input-group"><span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                    <input id="title" name="title" placeholder="Title" class="form-control" required="true" type="text">
                                </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-2 control-label">Image</label>
                                <div class="col-md-9 inputGroupContainer">
                                    <div class="input-group"><span class="input-group-addon"><i class="fa fa-file-photo-o"></i></span>
                                    <input id="img" name="img"  class="form-control" required="true" type="file">
                                </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-2 control-label">Decription</label>
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
<div id="editAboutModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <center><h4 class="modal-title">Testimony Form</h4></center>
                </div>
                <div class="modal-body">
                    <form class="well form-horizontal" action="{{ route('cms.update-about') }}" method="post" enctype="multipart/form-data">  
                        {{ csrf_field() }}
                        <fieldset>
                            <input id="id" name="id" type="hidden">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Title</label>
                                <div class="col-md-9 inputGroupContainer">
                                    <div class="input-group"><span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                    <input id="title_edit" name="title" placeholder="Title" class="form-control" required="true" type="text">
                                </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Image</label>
                                <div class="col-md-9 inputGroupContainer">
                                    <div class="input-group"><span class="input-group-addon"><i class="fa fa-file-photo-o"></i></span>
                                    <input id="img" name="img"  class="form-control" type="file">
                                </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Description</label>
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
          var table = $('.about-us').DataTable({
              rowCallback: function(row, data, index){
                $(row).find('td').css('vertical-align', 'middle');
              },
              destroy: true,
              processing: true,
              serverSide: true,
              ajax: {
                url: "{{ route('cms.about-us.index') }}", 
              },
              
              columns: [
                  { data: 'DT_RowIndex', name: 'DT_RowIndex', className: "text-center", orderable: false, searchable: false },
                  { data: 'title', name: 'title', className: "text-center" },                  
                  { data: 'desc', name: 'desc', className: "text-center" },
                  { data: 'image_url', name: 'image_url', className: 'text-center', searchable: false,
                    render: function(data) {
                       if(data === 'No Image') {
                           return 'No Image';
                       }
                       return '<image width="100px" height="100px" src="'+data+'"></image>';
                    },
                  },                   
                  { data: 'status', name: 'status', className: "text-center" },                  
                  { data: 'action', name: 'action', orderable: false, searchable: false, className: "text-center" },
              ]
          });
          
        });

        $(document).on('click', '.delete-about', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            var url =   "{{url('backoffice/cms/about-us/')}}"
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
                                window.location.href = "{{ route('cms.about-us.index') }}";
                            }         
                    });
            });
        });

        $(document).on('click', '.publish-about-us', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            var url =   "{{url('backoffice/cms/about-us/published/')}}"
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
                                window.location.href = "{{ route('cms.about-us.index') }}";
                            }         
                    });
            });
        });

        $(document).on('click', '.unpublish-about-us', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            var url =   "{{url('backoffice/cms/about-us/unpublished/')}}"
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
                                window.location.href = "{{ route('cms.about-us.index') }}";
                            }         
                    });
            });
        });


        $(document).on('click','.edit-about',function(){
   
            var id = $(this).data('id');
            
            var url =   "{{url('backoffice/cms/about-us/')}}" +'/'+ id +'/edit';
            // console.log('Image')
            // console.log(url)

            $.get(url, function (data) {
                //success data
                console.log(data);
                $('#id').val(data.id);
                $('#title_edit').val(data.title);
                $('#desc_edit').val(data.desc);

                $('#btn-save').val("update");
                $('#editAboutModal').modal('show');
            }) 
        });
       
      </script>
      
@endsection
