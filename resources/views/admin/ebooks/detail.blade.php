@extends('layouts.admin')

@section('title')
List Of {{$data->title}}
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
                        <a style=" color: white; text-decoration: none; margin-right: 20px; !important" href="{{ route('ebook.edit', $data->id) }}"><i style="font-size:15px;" class="fa fa-pencil"></i>&nbsp; &nbsp;<strong>Edit Data</strong></a>
                        <a data-id="{{$data->id}}" style=" color: white; text-decoration: none !important"><i style="font-size:15px;" class="fa fa-power-off"></i>&nbsp; &nbsp;<strong>Delete</strong></a>
                     
                     </div>
                </div>
                  
                    <div class="col-md-3">
                        <br>
                        <div>
                            <label class="control-label">Pice &nbsp; : &nbsp; {{currency($data->price)}} </label>
                        </div>  
                        <br>                              
                    </div>
                    <div class="col-md-3">
                        <br>
                        <div>
                            <label class="control-label">Markup Price &nbsp; : &nbsp; {{currency($data->price_markup)}} </label>
                        </div>
                        <br>                                
                    </div>
                    <div class="col-md-3">
                        <br>
                        <div>
                            <label class="control-label">Point Value &nbsp; : &nbsp; {{currency($data->pv)}} </label>
                        </div>
                        <br>                                
                    </div>
                    <div class="col-md-3">
                        <br>
                        <div>
                            <label class="control-label">Bonus Value &nbsp; : &nbsp; {{currency($data->bv)}} </label>
                        </div>
                        <br>
                    </div>
            </div>

            <div class="portlet box primary" style="margin-top: 15px;">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-book"></i> &nbsp;
                        Book List
                    </div>
                    <div class="pull-right">
                        <a style=" color: white; text-decoration: none !important" href="{{ route('ebook.create.book', $data->id) }}"><i style="font-size:15px;" class="fa fa-plus"></i>&nbsp; &nbsp;<strong>Create New Book</strong></a>
                     </div>
                </div>
                
                <div class="portlet-body flip-scroll">
                    <table class="table books-table table-bordered table-striped table-condensed flip-content" >
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
                        <i class="fa fa-video-camera"></i> &nbsp;
                        Video List
                    </div>
                    <div class="pull-right">
                        <a style=" color: white; text-decoration: none !important" href="{{ route('ebook.create.book', $data->id) }}"><i style="font-size:15px;" class="fa fa-plus"></i>&nbsp; &nbsp;<strong>Create New Videos</strong></a>
                     </div>
                </div>
                
                <div class="portlet-body flip-scroll">
                    <table class="table video-table table-bordered table-striped table-condensed flip-content" >
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
        </div>
    </div>
 </section>

@stop

@section('footer_scripts')
    <script type="text/javascript">
        $(document).ready(function () {
          var table = $('.books-table').DataTable({
              destroy: true,
              processing: true,
              serverSide: true,
              ajax: {
                url: "{{ route('ebook.bookData', $data->id) }}", 
              },
              
              columns: [
                  { data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false },
                  { data: 'title', name: 'title' },                  
                  { data: 'action', name: 'action', orderable: false, searchable: false, className: "text-center" },
              ]
          });  
        });

        $(document).ready(function () {
          var table = $('.video-table').DataTable({
              destroy: true,
              processing: true,
              serverSide: true,
              ajax: {
                url: "{{ route('ebook.videoData', $data->id) }}", 
              },
              
              columns: [
                  { data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false },
                  { data: 'title', name: 'title' },                  
                  { data: 'action', name: 'action', orderable: false, searchable: false, className: "text-center" },
              ]
          });
        });

        $(document).on('click', '.fa-power-off', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            swal({
                    title: "Are you sure!",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes!",
                    showCancelButton: true,
                },
                function() {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('ebook.destroy', $data->id) }}",
                        data: {id:id},
                        success: function (data) {
                                window.location.href = "{{ route('ebook.index') }}";
                            }         
                    });
            });
        });
      </script>
      
@endsection
