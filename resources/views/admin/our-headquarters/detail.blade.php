@extends('layouts.admin')

@section('title')
{{$data->title}}
@parent
@stop

@section('content')

<section class="content-header">
    <h1>{{$data->title}} Overview </h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">Ebook </a>
        </li>
        <li class="active">{{$data->title}} </li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            
            <div class="portlet box primary" style="margin-top: 15px;">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-area-chart"></i> &nbsp;
                        Overview
                    </div>

                    <div class="pull-right">
        
                        <a href="#" data-id="{{$data->id}}" class="edit-headquarter" style=" color: white; text-decoration: none !important"><i style="font-size:15px;" class="fa fa-pencil edit-headquarter"></i>&nbsp; &nbsp;<strong>Edit Data</strong></a>
                        <!-- <a style=" color: white; text-decoration: none; margin-right: 20px; !important" href="{{ route('cms.our-products.edit', $data->id) }}"><i style="font-size:15px;" class="fa fa-pencil"></i>&nbsp; &nbsp;<strong>Edit Data</strong></a> -->
                     </div>
                </div>
                  
                    <div class="col-md-12">
                        <br>
                        <div class="col-md-1">
                            <label class="control-label">Title </label>
                        </div>  
                        <div class="col-md-1">
                            :
                        </div>  
                        <div class="col-md-8">
                          {{($data->title)}}
                        </div>  
                        <br>
                    </div>
                    <div class="col-md-12">
                        <br>
                        <div class="col-md-1">
                            <label class="control-label">Desc </label>
                        </div>  
                        <div class="col-md-1">
                            :
                        </div>  
                        <div class="col-md-8">
                            {!!$data->desc !!}
                        </div>  
                        <br>
                    </div>
            </div>
        </div>
    </div>
 </section>


 <section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box primary" style="margin-top: 15px;">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="livicon" data-name="notebook" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Image Table
                    </div>

                    <div class="pull-right">
                        <a style=" color: white; text-decoration: none !important" href="#addAttachmentModal" data-toggle="modal"><i style="font-size:15px;" class="fa fa-plus"></i>&nbsp; &nbsp;<strong>Add Image</strong></a>
                    </div>
                </div>
                
                <div class="portlet-body flip-scroll">
                    <table class="table data-table table-bordered table-striped table-condensed flip-content images" >
                        <thead class="flip-content">
                            <tr>
                                <th class="text-center" width="5%">No</th>
                                <th class="text-center" width="30%">Name</th>
                                <th class="text-center" width="20%">Status</th>
                                <th class="text-center" width="20%">Image</th>
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

<!-- Edit -->
<div id="editHeadquarterModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <center><h4 class="modal-title">Edit Data</h4></center>
                </div>
                <div class="modal-body">
                    <form class="well form-horizontal" action="{{ route('cms.our-headquarters.update') }}" method="post">  
                        {{ csrf_field() }}
                        <fieldset>
                            <input id="id" name="id" type="hidden">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Title</label>
                                <div class="col-md-9 inputGroupContainer">
                                    <div class="input-group"><span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                    <input id="title" name="title" placeholder="Title" class="form-control" required="true" type="text">
                                </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Description</label>
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

<!-- Create -->
<div id="addAttachmentModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <center><h4 class="modal-title">Attachment Form</h4></center>
                </div>
                <div class="modal-body">
                    <form class="well form-horizontal" action="{{ route('cms.our-headquarters.images.upload') }}" method="post">  
                        {{ csrf_field() }}
                        <fieldset>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Title</label>
                                <div class="col-md-9 inputGroupContainer">
                                    <div class="input-group"><span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                    <input id="name" name="name" placeholder="File Name" class="form-control" required="true" type="text">
                                </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-2 control-label">Image</label>
                                <div class="col-md-9 inputGroupContainer">
                                    <div class="input-group"><span class="input-group-addon"><i class="fa fa-file-photo-o"></i></span>
                                    <input id="path" name="path"  class="form-control" required="true" type="file">
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

<!-- Edit -->
<div id="editAttachmentModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <center><h4 class="modal-title">Attachment Form</h4></center>
                </div>
                <div class="modal-body">
                    <form class="well form-horizontal" action="{{ route('cms.our-headquarters.images.update') }}" method="post" enctype="multipart/form-data">  
                        {{ csrf_field() }}
                        <fieldset>
                            <input id="id" name="id" type="hidden">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Title</label>
                                <div class="col-md-9 inputGroupContainer">
                                    <div class="input-group"><span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                    <input id="name_edit" name="name" placeholder="File Name" class="form-control" required="true" type="text">
                                </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Image</label>
                                <div class="col-md-9 inputGroupContainer">
                                    <div class="input-group"><span class="input-group-addon"><i class="fa fa-file-photo-o"></i></span>
                                    <input id="path" name="path"  class="form-control" type="file">
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
          var table = $('.images').DataTable({
              rowCallback: function(row, data, index){
                $(row).find('td').css('vertical-align', 'middle');
              },
              destroy: true,
              processing: true,
              serverSide: true,
              ajax: {
                url: "{{ route('cms.our-headquarters.images') }}", 
              },
              
              columns: [
                  { data: 'DT_RowIndex', name: 'DT_RowIndex', className: "text-center", orderable: false, searchable: false },
                  { data: 'name', name: 'name', className: "text-center" },    
                  { data: 'status', name: 'status', className: "text-center" },                
                  { data: 'image_url', name: 'image_url', className: 'text-center', searchable: false,
                    render: function(data) {
                       if(data === 'No Image') {
                           return 'No Image';
                       }
                       return '<image width="100px" height="100px" src="'+data+'"></image>';
                    },
                  },                                
                  { data: 'action', name: 'action', orderable: false, searchable: false, className: "text-center" },
              ]
          });
          
        });

        $(document).on('click', '.delete-attachment', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            var url =   "{{url('backoffice/cms/our-headquarters/images/')}}"
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
                                window.location.href = "{{ route('cms.our-headquarters.show') }}";
                            }         
                    });
            });
        });

        $(document).on('click', '.publish-attachment', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            var url =   "{{url('backoffice/cms/our-headquarters/images/published')}}"
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
                                window.location.href = "{{ route('cms.our-headquarters.show') }}";
                            }         
                    });
            });
        });

        $(document).on('click', '.unpublish-attachment', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            var url =   "{{url('backoffice/cms/our-headquarters/images/unpublished/')}}"
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
                                window.location.href = "{{ route('cms.our-headquarters.show') }}";
                            }         
                    });
            });
        });


        $(document).on('click','.edit-attachment',function(){
   
            var id = $(this).data('id');
            
            var url =   "{{url('backoffice/cms/our-headquarters/images/')}}" +'/'+ id +'/edit';

            $.get(url, function (data) {
                //success data
                console.log(data);
                $('#id').val(data.id);
                $('#name_edit').val(data.name);

                $('#btn-save').val("update");
                $('#editAttachmentModal').modal('show');
            }) 
        });


        $(document).on('click','.edit-headquarter',function(){
   
            var id = $(this).data('id');
            
            var url =   "{{url('backoffice/cms/our-headquarters/edit')}}" +'/'+ id;
            console.log(url);

            $.get(url, function (data) {
                //success data
                console.log(data);
                $('#id').val(data.id);
                $('#title').val(data.title);
                $('#desc').val(data.desc);

                $('#btn-save').val("update");
                $('#editHeadquarterModal').modal('show');
            }) 
        });
       
      </script>
      
@endsection
