@extends('layouts.admin')

@section('title')
Detail Book
@parent
@stop

@section('content')

<section class="content-header">
    <h1>{{$data->title}} Overview </h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('ebook.index') }}">Ebook </a>
        </li>
        <li>
            <a href="{{ route('ebook.show', $data->bookEbook->ebook_id) }}">{{optional($data->bookEbook)->ebook_title}} </a>
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
                        Content
                    </div>

                    <div class="pull-right">
                        <a style=" color: white; text-decoration: none; margin-right: 20px; !important" href="{{ route('book.edit', $data->id) }}"><i style="font-size:15px;" class="fa fa-pencil"></i>&nbsp; &nbsp;<strong>Edit Data</strong></a>
                        <a data-id="{{$data->id}}" style=" color: white; text-decoration: none !important"><i style="font-size:15px;" class="fa fa-power-off"></i>&nbsp; &nbsp;<strong>Delete</strong></a>
                     
                     </div>
                </div>
                  
                    <div class="col-md-12">
                        <br>
                        <div>
                            {!!$data->article!!}
                        </div>  
                        <br>                              
                    </div>
            </div>

            <div class="portlet box primary" style="margin-top: 15px;">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-book"></i> &nbsp;
                        Lesson List
                    </div>
                    <div class="pull-right">
                        <a style=" color: white; text-decoration: none; margin-right: 20px; !important" href="{{ route('book.create.lesson', $data->id) }}"><i style="font-size:15px;" class="fa fa-plus"></i>&nbsp; &nbsp;<strong>Add New Lesson</strong></a>
                     </div>
                </div>
                
                <div class="portlet-body flip-scroll">
                    <table class="table chapters-table table-bordered table-striped table-condensed flip-content" >
                        <thead class="flip-content">
                            <tr>
                                <th>No</th>
                                <th class="text-center" width="60%">Title</th>
                                <th width="30%">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <div class="portlet box primary" style="margin-top: 15px;">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-file-photo-o"></i> &nbsp;
                        Image List
                    </div>
                    <div class="pull-right">
                        <a style=" color: white; text-decoration: none !important" href="#addImageModal" data-toggle="modal"><i style="font-size:15px;" class="fa fa-plus"></i>&nbsp; &nbsp;<strong>Add New Image</strong></a>
                     </div>
                </div>
                
                <div class="portlet-body flip-scroll">
                    <table class="table images-table table-bordered table-striped table-condensed flip-content" >
                        <thead class="flip-content">
                            <tr>
                                <th>No</th>
                                <th class="text-center" style="vertical-align : middle;" width="45%">Title</th>
                                <th class="text-center" width="25%">Image</th>
                                <th width="30%">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
 </section>


<!--section ends-->
<div id="addImageModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Book Image</h4>
                </div>
                <div class="modal-body">
                    <form class="well form-horizontal" action="{{ route('book-image.store') }}" method="post" enctype="multipart/form-data">  
                        {{ csrf_field() }}
                        <fieldset>
                        <input id="book_id" name="book_id" value="{{$data->id}}" type="hidden">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Name</label>
                                <div class="col-md-9 inputGroupContainer">
                                    <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-piggy-bank"></i></span>
                                    <input id="name" name="name" placeholder="Name" class="form-control" required="true" value="" type="text">
                                </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Image</label>
                                <div class="col-md-9 inputGroupContainer">
                                    <div class="input-group"><span class="input-group-addon"><i class="fa fa-file-photo-o"></i></span>
                                    <input id="src" name="src"  class="form-control" required="true" type="file">
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
<div id="editImageModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Book Image</h4>
                </div>
                <div class="modal-body">
                    <form class="well form-horizontal" action="{{url('backoffice/update-image/')}}" method="post" enctype="multipart/form-data">  
                        {{ csrf_field() }}
                        <fieldset>
                        <input id="image_id_edit" name="image_id" type="hidden">
                        <input id="book_id_edit" name="book_id" type="hidden">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Name</label>
                                <div class="col-md-9 inputGroupContainer">
                                    <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-piggy-bank"></i></span>
                                    <input id="name_edit" name="name" placeholder="Name" class="form-control" required="true" value="" type="text">
                                </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Image</label>
                                <div class="col-md-9 inputGroupContainer">
                                    <div class="input-group"><span class="input-group-addon"><i class="fa fa-file-photo-o"></i></span>
                                    <input id="name_edit" name="src"  class="form-control" type="file">
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

{{-- page level scripts --}}
@section('footer_scripts')
    <script type="text/javascript">
            $(document).ready(function () {
          var table = $('.chapters-table').DataTable({
              destroy: true,
              processing: true,
              serverSide: true,
              ajax: {
                url: "{{ route('book.chapterData', $data->id) }}", 
              },
              
              columns: [
                  { data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false, className: "text-center"  },
                  { data: 'title', name: 'title' },                  
                  { data: 'action', name: 'action', orderable: false, searchable: false, className: "text-center" },
              ]
          });  
        });

        $(document).ready(function () {
          var table = $('.images-table').DataTable({
            rowCallback: function(row, data, index){
                $(row).find('td').css('vertical-align', 'middle');
             },
              destroy: true,
              processing: true,
              serverSide: true, 
              ajax: {
                url: "{{ route('book.imageData', $data->id) }}", 
              },
              
              columns: [
                  { data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false, className: "text-center"  },
                  { data: 'name', name: 'name', className: 'text-center'},                  
                  { data: 'image_url', name: 'image_url', className: 'text-center',
                    render: function(data) {
                       if(!data) {
                           return 'No Image';
                       }
                       return '<image width="100px" height="100px" src="'+data+'"></image>';
                    },
                  },                  
                  { data: 'action', name: 'action', orderable: false, searchable: false, className: "text-center" },
              ]
          });
        });

        $(document).on('click','.edit-image',function(){
   
            var id = $(this).data('id');
           
            var url =   "{{url('backoffice/book-image/')}}" +'/'+ id +'/edit';
            console.log('Image')
            console.log(url)

            $.get(url, function (data) {
                //success data
                console.log(data);
                $('#image_id_edit').val(data.id);
                $('#name_edit').val(data.name);

                $('#btn-save').val("update");
                $('#editImageModal').modal('show');
            }) 
        });

       
      </script>
@stop
