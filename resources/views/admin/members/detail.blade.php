@extends('layouts.admin')

@section('title')
{{$data->id_member}}
@parent
@stop

@section('content')

<section class="content-header">
    <h1>{{$data->title}} Overview </h1>
    <ol class="breadcrumb">
        <li>
            @if($data->status == 1)
            <a href="{{ route('members.active.index') }}">Members </a>
            @elseif($data->status == 0)
            <a href="{{ route('members.nonactive.index') }}">Members </a>
            @endif
        </li>
        <li class="active">Detail </li>
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
                        <a style=" color: white; text-decoration: none; margin-right: 20px; !important" href="{{ route('members.edit-data', $data->id) }}"><i style="font-size:15px;" class="fa fa-pencil"></i>&nbsp; &nbsp;<strong>Edit Data</strong></a>
                     
                     </div>
                </div>
            
                <div class="col-md-10 col-md-offset-1">
                    <br>
                    <div class="col-md-6">
                
                        <div class="form-group">
                             <label class="control-label col-md-4">ID Member &nbsp; </label>: &nbsp;{{ $data->id_member }} 
                        </div>  

                        <div class="form-group">
                             <label class="control-label col-md-4">NIK &nbsp; </label>: &nbsp;{{ $data->nik }}
                        </div> 

                        <div class="form-group">
                             <label class="control-label col-md-4">Name &nbsp; </label>: &nbsp;{{ $data->first_name }} {{$data->last_name}}
                        </div>  

                        <div class="form-group">
                             <label class="control-label col-md-4">Username &nbsp; </label>: &nbsp;{{ $data->username }}
                        </div> 

                        <div class="form-group">
                            <label class="control-label col-md-4">Position &nbsp; </label>: &nbsp;
                            @if ( $data->position == 0 )
                                Left
                            @elseif ($data->position == 1)
                                Middle
                            @elseif ($data->position == 2)
                                Right
                            @endif
                        </div> 

                        <div class="form-group">
                                <label class="control-label col-md-4">Email &nbsp; </label>: &nbsp;{{ $data->email }}
                        </div>  

                        <div class="form-group">
                                <label class="control-label col-md-4">Acount Number &nbsp; </label>: &nbsp;{{ $data->no_rec }} 
                        </div>  

                        <div class="form-group">
                                <label class="control-label col-md-4">NPWP &nbsp; </label>: &nbsp;{{ $data->npwp_number }} 
                        </div>  

                        <div class="form-group">
                                <label class="control-label col-md-4">Birthdate &nbsp; </label>: &nbsp;{{ $data->birthdate }} 
                        </div>  
                    </div>
        
                    <div class="col-md-6">
                
                        <div class="form-group">
                                <label class="control-label col-md-4">Phone Number &nbsp; </label>: &nbsp;{{ $data->phone_number }}
                        </div> 

                        <div class="form-group">
                                <label class="control-label col-md-4">Gender &nbsp; </label>: &nbsp;{{ $data->gender == '1' ? 'Female' : 'Male' }}
                        </div> 
                        

                        <div class="form-group">
                                <label class="control-label col-md-4">Marital Status &nbsp; </label>: &nbsp;

                                    @if ( $data->status == '1' )
                                    Married
                                    @elseif ( $data->status == '0' )
                                    Single
                                    @endif
                        </div> 

                        <div class="form-group">
                                <label class="control-label col-md-4">Status &nbsp; </label>: &nbsp;{{ $data->status == '1' ? 'Active' : 'Non Active' }}
                        </div> 

                        <div class="form-group">
                                <label class="control-label col-md-4">Profile Pict &nbsp; </label>
                                @if ( $data->src )
                                <img src="{{ URL::to('/') }}/{{$data->src}}" alt="profile Pic" height="200" width="200">
                                @else
                                <img src="{{ URL::to('/') }}/img/avatar.png" alt="profile Pic" height="200" width="200">
                                @endif
                        </div> 

                    </div>
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

        $(document).on('click', '.delete-video', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            console.log(id)
            var urlVideo =   "{{url('backoffice/deleteVideo/')}}"
            // console.log(urlVideo);

            swal({
                    title: "Are you sure delete this video ?",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes!",
                    showCancelButton: true,
                },
                function() {
                    $.ajax({
                        type: "DELETE",
                        url: urlVideo + '/' + id,
                        data: {id:id},
                        success: function (data) {
                                window.location.href = "{{ route('ebook.index')}}";
                            }         
                    });
            });
        });
      </script>
      
@endsection
