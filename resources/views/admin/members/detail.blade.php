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
                    <div class="caption" style="margin-right: 25px;">
                        <i class="fa fa-money"></i> &nbsp;
                        Cash {{currency($data->bitrex_cash)}}
                    </div>

                    <div class="caption">
                        <i class="fa fa-area-chart"></i> &nbsp;
                        Point {{$data->bitrex_points}}
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


            <div class="portlet box primary" style="margin-top: 55px;">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-book"></i> &nbsp;
                        Point Histories
                    </div>
                    <div class="pull-right">
                        <a style=" color: white; text-decoration: none !important;" onMouseOut="this.style.color='white'" onMouseOver="this.style.color='#f06262'" href="#addTopUpModal" data-toggle="modal"><i style="font-size:15px;" class="fa fa-money"></i>&nbsp; &nbsp;<strong>Topup</strong></a>
                     </div>
                </div>
                
                <div class="portlet-body flip-scroll">
                    <table class="table points-table table-bordered table-striped table-condensed flip-content" >
                        <thead class="flip-content">
                            <tr>
                                <th width="5%">No</th>
                                <th class="text-center" width="20%">Transaction</th>
                                <th class="text-center" width="15%">Point</th>
                                <th class="text-center" width="25%">Description</th>
                                <th class="text-center" width="20%">Time</th>
                                <th width="15%">Info</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <div class="portlet box primary" style="margin-top: 55px;">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-book"></i> &nbsp;
                        Cash Histories
                    </div>
                </div>
                
                <div class="portlet-body flip-scroll">
                    <table class="table cash-table table-bordered table-striped table-condensed flip-content" >
                        <thead class="flip-content">
                            <tr>
                                <th width="5%">No</th>
                                <th class="text-center" width="20%">Transaction</th>
                                <th class="text-center" width="25%">Description</th>
                                <th class="text-center" width="20%">Time</th>
                                <th width="15%">Info</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

        </div>
    </div>
 </section>


<!--section ends-->
<div id="addTopUpModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Topup For {{$data->username}} / {{$data->id_member}}</h4>
                </div>
                <div class="modal-body">
                    <form class="well form-horizontal" action="{{ route('members.topup') }}">  
                        {{ csrf_field() }}
                        <fieldset>
                        <input id="name" name="name" value="{{$data->id}}" type="hidden">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Nominal</label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-piggy-bank"></i></span><input id="nominal" name="nominal" placeholder="Nominal" class="form-control" required="true" value="" type="number"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Description</label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-book"></i></span><textarea name="description" id="description" cols="30" rows="10" placeholder="Description" class="form-control" required="true" value=""></textarea></div>
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
          var table = $('.points-table').DataTable({
              destroy: true,
              processing: true,
              serverSide: true,
              ajax: {
                url: "{{ route('members.points.history', $data->id) }}", 
              },
              
              columns: [
                  { data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false },
                  { data: 'nominal', name: 'nominal', className: "text-center"  },                  
                  { data: 'points', name: 'points', className: "text-center"  },                  
                  { data: 'description', name: 'description' },                  
                  { data: 'created_at', name: 'created_at', className: "text-center"  },                  
                  { data: 'info', name: 'info', className: "text-center"  },                  

              ]
          });  
        });

        $(document).ready(function () {
          var table = $('.cash-table').DataTable({
              destroy: true,
              processing: true,
              serverSide: true,
              ajax: {
                url: "{{ route('members.cash.history', $data->id) }}", 
              },
              
              columns: [
                  { data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false },
                  { data: 'nominal', name: 'nominal', className: "text-center"  },                                  
                  { data: 'description', name: 'description' },                  
                  { data: 'created_at', name: 'created_at', className: "text-center"  },                  
                  { data: 'info', name: 'info', className: "text-center"  },                  

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
