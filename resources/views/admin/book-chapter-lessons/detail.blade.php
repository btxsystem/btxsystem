@extends('layouts.admin')

@section('title')
Lesson Overview
@parent
@stop

@section('content')

<section class="content-header">
    <h1>{{$data->title}} Overview </h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{route('book.show', $data->book_id)}}">Book </a>
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
                        Detail Lesson
                    </div>

                    <div class="pull-right">
                        <a style=" color: white; text-decoration: none; margin-right: 20px; !important" href="{{ route('book-chapter-lesson.edit', $data->id) }}"><i style="font-size:15px;" class="fa fa-pencil"></i>&nbsp; &nbsp;<strong>Edit Data</strong></a>
                        <a style=" color: white; text-decoration: none !important">
                            <i style="font-size:15px;" class="fa fa-power-off"></i>&nbsp; &nbsp;<strong>Delete</strong></a>
                     
                     </div>
                </div>
                  
                    <div class="col-md-12">
                        <br>
                        <div>
                            {!! $data->content !!}
                        </div>  
                        <br>                              
                    </div>
  
            </div>

        </div>
    </div>
 </section>

@stop

@section('footer_scripts')
    <script type="text/javascript">
        $(document).on('click', '.fa-power-off', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            var returnBack = "{{route('book.show', $data->book_id)}}" 
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
                        url: "{{ route('book-chapter-lesson.destroy', $data->id) }}",
                        data: {id:id},
                        success: function (data) {
                                window.location.href = returnBack;
                            }         
                    });
            });
        });
      </script>
      
@endsection
