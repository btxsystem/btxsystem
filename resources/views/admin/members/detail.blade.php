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

                    <div class="caption" style="margin-right: 25px;">
                        <i class="fa fa-area-chart"></i> &nbsp;
                        Point {{$data->bitrex_points}}
                    </div>

                    <div class="caption" style="margin-right: 25px;">
                        <i class="fa fa-balance-scale"></i> &nbsp;
                        PV {{$data->pv}}
                    </div>

                    <div class="pull-right">
                        @if(\Auth::guard('admin')->user()->hasPermission('Members.edit_password'))
                            <a style="color: white; text-decoration: none !important;" onMouseOut="this.style.color='white'" onMouseOver="this.style.color='#f06262'" href="#updatePasswordModal" data-toggle="modal"><i style="font-size:15px;" class="fa fa-refresh"></i>&nbsp; &nbsp;<strong>Update Password</strong></a>
                            &nbsp; &nbsp;
                        @endif
                        @if(\Auth::guard('admin')->user()->hasPermission('Members.edit'))
                            <a onMouseOut="this.style.color='white'" onMouseOver="this.style.color='#f06262'" style=" color: white; text-decoration: none; margin-right: 20px; !important" href="{{ route('members.edit-data', $data->id) }}"><i style="font-size:15px;" class="fa fa-pencil"></i>&nbsp; &nbsp;<strong>Edit Data</strong></a>
                        @endif
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
                             <label class="control-label col-md-4">Rank &nbsp; </label>: &nbsp;{{ optional($data->rank)->name }}
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
                                <label class="control-label col-md-4">Sponsor &nbsp; </label>: &nbsp;{{ $data->sponsor ? $data->sponsor->username : '-' }}
                        </div>

                        <div class="form-group">
                                <label class="control-label col-md-4">Bank Account &nbsp; </label>: &nbsp;{{ $data->no_rec }}
                        </div>

                        <div class="form-group">
                                <label class="control-label col-md-4">Account Name &nbsp; </label>: &nbsp;{{ $data->bank_account_name }}
                        </div>

                        <div class="form-group">
                                <label class="control-label col-md-4">Bank Name &nbsp; </label>: &nbsp;{{ $data->bank_name }}
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
                                <label class="control-label col-md-4">Email &nbsp; </label>: &nbsp;{{ $data->email }}
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
                            @php
                                $date = str_replace('-', '/', $data->expired_at);
                                $tomorrow = date('Y-m-d 00:00:00', strtotime($date . "+1 days"));
                            @endphp 
                            <label class="control-label col-md-4">Status &nbsp; </label>: &nbsp;{{ $data->status == '1' ? 'Active' : 'Non Active' }} ({{$tomorrow}})
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4">Province &nbsp; </label>: &nbsp;{{ $data->address ? strtolower($data->address->province) : '-' }}
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4">City &nbsp; </label>: &nbsp;{{ $data->address ? strtolower($data->address->city_name) : '-' }}
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4">District &nbsp; </label>: &nbsp;{{ $data->address ? strtolower($data->address->subdistrict_name) : '-' }}
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4">Address &nbsp; </label>: &nbsp;{{ $data->address ? strtolower($data->address->decription) : '-' }}
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
                        Bitrex Point Histories
                    </div>
                    <div class="pull-right">
                        @if(\Auth::guard('admin')->user()->hasPermission('Members.refund'))
                            <a style=" color: white; text-decoration: none !important;" onMouseOut="this.style.color='white'" onMouseOver="this.style.color='#f06262'" href="#refoundModal" data-toggle="modal"><i style="font-size:15px;" class="fa fa-money"></i>&nbsp; &nbsp;<strong>Refund</strong></a>
                            &nbsp;
                        @endif
                        @if(\Auth::guard('admin')->user()->hasPermission('Members.Topup'))
                            <a style=" color: white; text-decoration: none !important;" onMouseOut="this.style.color='white'" onMouseOver="this.style.color='#f06262'" href="#addTopUpModal" data-toggle="modal"><i style="font-size:15px;" class="fa fa-money"></i>&nbsp; &nbsp;<strong>Topup</strong></a>
                        @endif
                    </div>
                </div>

                <div class="portlet-body flip-scroll">
                    <table class="table points-table table-bordered table-striped table-condensed flip-content" >
                        <thead class="flip-content">
                            <tr>
                                <th width="5%">No</th>
                                <th class="text-center" width="15%">Transaction</th>
                                <th class="text-center" width="15%">Point</th>
                                <th class="text-center" width="25%">Description</th>
                                <th class="text-center" width="15%">Time</th>
                                <th width="15%">Status</th>
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
                        Transaction Member
                    </div>
                    <div class="pull-right">
                        @if(\Auth::guard('admin')->user()->hasPermission('Members.Buy_product'))
                            <a style=" color: white; text-decoration: none !important;" onMouseOut="this.style.color='white'" onMouseOver="this.style.color='#f06262'" href="#buyProduct" data-toggle="modal"><i style="font-size:15px;" class="fa fa-cart-plus"></i>&nbsp; &nbsp;<strong>Buy Product</strong></a>
                        @endif
                    </div>
                </div>

                <div class="portlet-body flip-scroll">
                    <table class="table transaction-table table-bordered table-striped table-condensed flip-content" >
                        <thead class="flip-content">
                            <tr>
                                <th width="5%">No</th>
                                <th class="text-center" width="20%">Title</th>
                                <th class="text-center" width="15%">Price</th>
                                <th class="text-center" width="15%">Point Value</th>
                                <th width="15%">Bitrax Value</th>
                                <th width="15%">Time</th>
                                <th width="15%">Expired</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <div class="portlet box primary" style="margin-top: 55px;">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-book"></i> &nbsp;
                        Bitrex Value Histories
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
            <div class="portlet box primary" style="margin-top: 55px;">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-book"></i> &nbsp;
                        PV Pairing Histories
                    </div>
                </div>

                <div class="portlet-body flip-scroll">
                    <table class="table pv-pairing-table table-bordered table-striped table-condensed flip-content" >
                        <thead class="flip-content">
                            <tr>
                                <th width="5%">No</th>
                                <th class="text-center" width="10%">PV Left Before</th>
                                <th class="text-center" width="10%">PV Middle Before</th>
                                <th class="text-center" width="10%">PV Right Before</th>
                                <th class="text-center" width="10%">Pairing</th>
                                <th class="text-center" width="15%">Flush Out / Unqualified</th>
                                <th class="text-center" width="10%">PV Left Current</th>
                                <th class="text-center" width="10%">PV Middle Current</th>
                                <th class="text-center" width="10%">PV Right Current</th>
                                <th class="text-center" width="10%">Date</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>


            <div class="portlet box primary" style="margin-top: 55px;">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-book"></i> &nbsp;
                        Point Value Histories
                    </div>
                </div>

                <div class="portlet-body flip-scroll">
                    <table class="table pv-table table-bordered table-striped table-condensed flip-content" >
                        <thead class="flip-content">
                            <tr>
                                <th>No</th>
                                <th class="text-center">PV</th>
                                <th class="text-center">PV Today</th>
                                <th class="text-center">Time</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <div class="portlet box primary" style="margin-top: 55px;">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-book"></i> &nbsp;
                        TIme Reward Histories
                    </div>
                </div>

                <div class="portlet-body flip-scroll">
                <table id="time-reward" class="table data-table table-bordered table-striped table-condensed flip-content time-reward" >
                        <thead class="flip-content">
                            <tr>
                                <th>Ebook</th>
                                <th>From Date</th>
                                <th>To Date</th>
                                <th>Duration Ebook</th>
                                <th>Duration Member</th>
                                <th>Created By</th>
                                <th>Created At</th>
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
<div id="updatePasswordModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Change Password {{$data->username}}</h4>
                </div>
                <div class="modal-body">
                    <form class="well form-horizontal" action="{{ route('members.update-password') }}">
                        {{ csrf_field() }}
                        <fieldset>
                        <input id="id" name="id" value="{{$data->id}}" type="hidden">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Password</label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-key"></i>
                                        </span>
                                        <input id="password" name="password" placeholder="Password" class="form-control" required="true" value="" type="password">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Confirm Password</label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-key"></i>
                                        </span>
                                        <input id="comfirm_password" name="comfirm_password" placeholder="Confirm Password" class="form-control" required="true" value="" type="password">
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
                                    <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-piggy-bank"></i></span><input id="nominal" name="nominal" placeholder="Nominal" class="form-control" required="true" value="" min="10000" type="number"></div>
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
                                <button type="submit" disabled id="submit-bph" class="btn btn-primary">Submit</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
</div>

<div id="addExpiredModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Add Expired Ebook {{$data->username}} / {{$data->id_member}}</h4>
                </div>
                <div class="modal-body">
                    <form class="well form-horizontal" id="form_add_expired" method="post" action="" >
                        {{ csrf_field() }}
                        <fieldset>
                        <input id="transaction_id" name="transaction_id" type="hidden">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Date</label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-book"></i></span>
                                        <input id="added_expired" name="added_expired" placeholder="Date" class="form-control" required="true" type="datetime-local">
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <div class="modal-footer">
                                <button type="submit" id="submit-expired-modal" class="btn btn-primary">Submit</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
</div>

<div id="refoundModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Refund For {{$data->username}} / {{$data->id_member}}</h4>
            </div>
            <div class="modal-body">
                <form class="well form-horizontal" action="{{ route('members.refound') }}" id="refund-target">
                    {{ csrf_field() }}
                    <fieldset>
                    <input id="name" name="name" value="{{$data->id}}" type="hidden">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Total points</label>
                            <div class="col-md-8 inputGroupContainer">
                                <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-piggy-bank"></i></span><input readonly id="total_points" name="total_points" placeholder="Total points" class="form-control" required="true" value="{{$data->bitrex_points}}" type="number"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Refund points</label>
                            <div class="col-md-8 inputGroupContainer">
                                <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-piggy-bank"></i></span><input id="points" name="points" placeholder="Refund points" class="form-control" min="1" max="{{$data->bitrex_points}}" required="true" value="" type="number"></div>
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
                        <button type="button" id="submit-refund" disabled class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!--section ends-->
<div id="buyProduct" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Buy Product For {{$data->username}} / {{$data->id_member}}</h4>
                </div>
                <div class="modal-body">
                    <form class="well form-horizontal" action="{{ route('members.buy-product') }}">
                        {{ csrf_field() }}
                        <fieldset>
                        <input id="member_id" name="member_id" value="{{$data->id}}" type="hidden">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Ebook</label>
                            <div class="col-md-8 inputGroupContainer">
                                <select name="ebook_id" id="ebook_id" class="form-control" value="{{old('ebook_id')}}">
                                    @foreach($ebooks as $ebook)
                                    <option value="{{$ebook->id}}">{{$ebook->title}} - {{currency($ebook->price)}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <label class="col-md-3 control-label">Use Bitrex Points</label>
                            <div class="col-md-8 inputGroupContainer">
                                <input type="checkbox" style="margin-top:12px" name="isBp" value="1">
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
                  { data: 'status', name: 'status', className: "text-center"  },
                  { data: 'info', name: 'info', className: "text-center"  },

              ]
          });
        });

        $('#nominal').keyup(function() {
            let value = parseInt($(this).val())

            if(value < 10000) {
                $('#submit-bph').prop('disabled', true)
            } else {
                $('#submit-bph').prop('disabled', false)
            }
        })

        $('#nominal').change(function() {
            let value = parseInt($('#nominal').val())

            if(value < 10000) {
                $('#submit-bph').prop('disabled', true)
            } else {
                $('#submit-bph').prop('disabled', false)
            }
        })

        $('#points').keyup(function() {
            let value = parseInt($(this).val())

            if(value < 1 || value > parseInt($(this).prop("max"))) {
                $('#submit-refund').prop('disabled', true)
            } else {
                $('#submit-refund').prop('disabled', false)
            }
        })

        $('#points').change(function() {
            let value = parseInt($('#points').val())

            if(value < 1 || value > parseInt($('#points').prop("max"))) {
                $('#submit-refund').prop('disabled', true)
            } else {
                $('#submit-refund').prop('disabled', false)
            }
        })

        $('#submit-refund').click(function(){
            swal({
                    title: "Are you sure refund points ?",
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes!",
                    showCancelButton: true,
                },
                function() {
                    $('#refund-target').submit();
            });
        })

        $(document).ready(function () {
          var table = $('.pv-pairing-table').DataTable({
            rowCallback: function(row, data, index){
                $(row).find('td').css('vertical-align', 'middle');
              },
              destroy: true,
              processing: true,
              serverSide: true,
              ajax: {
                url: "{{ route('members.pv.history.pairing', $data->id) }}",
              },

              columns: [
                  { data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false },
                  { data: 'left', name: 'left', className: "text-center"  },
                  { data: 'midle', name: 'midle', className: "text-center"  },
                  { data: 'right', name: 'right', className: "text-center"  },
                  { data: 'total_pairing', name: 'total_pairing', className: "text-center"  },
                  { data: 'fail_pairing', name: 'fail_pairing', className: "text-center"  },
                  { data: 'current_left', name: 'current_left', className: "text-center"  },
                  { data: 'current_midle', name: 'current_midle', className: "text-center"  },
                  { data: 'current_right', name: 'current_right', className: "text-center"  },
                  { data: 'created_at', name: 'created_at', className: "text-center"  },
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

          var tableTimeReward = $('.time-reward').DataTable({
              destroy: true,
              processing: true,
              serverSide: true,
              responsive: true,
              ajax: {
                url: "{{ route('bonus.time-reward') }}?member={{$data->id}}", 
              },
              columns: [
                  {data: 'ebook.title', name: 'ebook.title', className: 'text-center'},
                  {data: 'from_date', name: 'from_date', className: 'text-center'},
                  {data: 'to_date', name: 'to_date', className: 'text-center'},
                  {data: 'total_duration', name: 'total_duration', className: 'text-center'},
                  {data: 'total_duration', name: 'total_duration', className: 'text-center'},
                  {data: 'admin.name', name: 'admin.name', className: 'text-center'},
                  {data: 'created_at', name: 'created_at', className: 'text-center'},
              ]
          });
        });

        $(document).ready(function () {
          var table = $('.pv-table').DataTable({
              destroy: true,
              processing: true,
              serverSide: true,
              ajax: {
                url: "{{ route('members.pv.history', $data->id) }}",
              },

              columns: [
                  { data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false },
                  { data: 'pv', name: 'pv', className: "text-center"  },
                  { data: 'pv_today', name: 'pv_today' },
                  { data: 'created_at', name: 'created_at', className: "text-center"  },
              ]
          });
        });

        $(document).ready(function () {
          var table = $('.transaction-table').DataTable({
              destroy: true,
              processing: true,
              serverSide: true,
              ajax: {
                url: "{{ route('members.transaction.member', $data->id) }}",
              },

              columns: [
                  { data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false },
                  { data: 'ebook.title', name: 'title', className: "text-center"  },
                  { data: 'ebook.price', name: 'price', className: "text-center"   },
                  { data: 'ebook.pv', name: 'pv', className: "text-center"   },
                  { data: 'ebook.bv', name: 'bv', className: "text-center"   },
                  { data: 'created_at', name: 'created_at', className: "text-center"   },
                  { data: 'expired_at', name: 'expired_at', className: "text-center"   },
                  { data: 'action', name: 'action', className: "text-center", orderable: false, searchable: false   },

              ]
          });
        });



        $(document).on('click', '.delete-video', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
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

        $(document).on('click', '.nonactive-ebook', function (e) {
            e.preventDefault();//
            // console.log(id);
            var url =   $(this).prop("href");
            swal({
                        title: "Are you sure to set Non Active Ebook this member ?",
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "Yes!",
                        showCancelButton: true,
                    },
                    function() {
                        window.location.href = url;
                });
        });

        $(document).on('click', '.add-expired-ebook', function (e) {
            e.preventDefault();
            $('#transaction_id').val($(this).data('id'))
            $('#addExpiredModal').modal('show')
            $('#form_add_expired').attr('action', $(this).data('action'))
        });
      </script>

@endsection
