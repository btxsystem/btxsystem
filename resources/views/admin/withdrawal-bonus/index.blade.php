@extends('layouts.admin')

@section('title')
Withdrawal Bonus
@parent
@stop

@section('content')
<style>
    div.dataTables_wrapper {
        width: 1100px;
        margin: 0 auto;
    }
</style>

<section class="content-header">
    <h1>Withdrawal Bonus </h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">Withdrawal Bonus</a>
        </li>
        <li class="active">Index</li>
    </ol>
</section>

<!-- Modal -->
<div class="modal fade" id="direct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Redirect</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <center>Are you sure to redirect member login ? </center>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="direct()">Submit</button>
        </div>
        </div>
    </div>
</div>

<div class="modal fade" id="nodirect" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Inactive Redirect</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <center>Are you sure to inactive redirect member login ? </center>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="nonredirect()">Submit</button>
        </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            @if(\Auth::guard('admin')->user()->hasPermission('Withdrawal.claim.redirect'))
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#direct">
                    Redirect
                </button>
            @endif
            @if(\Auth::guard('admin')->user()->hasPermission('Withdrawal.claim.nonredirect'))
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#nodirect">
                    Non Redirect
                </button>
            @endif
            <div class="portlet box primary" style="margin-top: 15px;">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="livicon" data-name="notebook" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Withdrawal Bonus  Table
                    </div>

                    <div class="pull-right">
                        @if(\Auth::guard('admin')->user()->hasPermission('Withdrawal.claim.paid_checked'))
                            <button type="button" name="bulk_paid" id="bulk_paid" class="btn btn-danger btn-sm">Paid Checked</button> &nbsp;
                        @endif
                        @if(\Auth::guard('admin')->user()->hasPermission('Withdrawal.claim.export_excel'))
                            <a onclick="return confirm('Are you sure to export data ?')" href="{{route('withdrawal-bonus.export')}}" target="_blank" class="btn btn-success btn-sm">Export Excel</a>
                        @endif
                        <!-- <a style=" color: white; text-decoration: none !important" href="{{route('withdrawal-bonus.export')}}" target="_blank" data-toggle="modal"><i style="font-size:15px;" class="fa fa-file-excel-o"></i>&nbsp; &nbsp;<strong>Export Excel</strong></a> -->
                    </div>
                </div>
                
                <div class="portlet-body flip-scroll">
                    <table id="member_table"  class="table data-table table-bordered table-striped table-condensed flip-content testimonial" >
                        <thead class="flip-content">
                            <!-- <tr>
                                <th class="text-center" width="5%">No</th>
                                <th class="text-center" width="15%">Name</th>
                                <th class="text-center" width="15%">No Rec</th>
                                <th class="text-center" width="15%">Username</th>
                                <th class="text-center" width="10%">B Sponsor</th>
                                <th class="text-center" width="10%">B Pairing</th>
                                <th class="text-center" width="10%">B Profit</th>
                                <th class="text-center" width="10%">B Reward</th>
                                <th class="text-center" width="15%">Bitrax Cash</th>
                                <th class="text-center" width="10%"><button type="button" name="bulk_paid" id="bulk_paid" class="btn btn-danger btn-xs">Paid Checked</button></th>
         -->
                                <th class="text-center">No</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Username</th>
                                <th class="text-center">No Rec</th>
                                <th class="text-center">Bank Name</th>
                                <th class="text-center">NPWP</th>
                                <th class="text-center">B Sponsor</th>
                                <th class="text-center">B Pairing</th>
                                <th class="text-center">B Profit</th>
                                <th class="text-center">B Reward</th>
                                <th class="text-center">Tax</th>
                                <th class="text-center">Bitrax Cash</th>
                                <th class="text-center">Check</th>
        
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

@stop

@section('footer_scripts')
    <script type="text/javascript">
        let direct = () => {
            $.ajax({
                type: 'POST',
                url: '{{route("redirect")}}',
                success: function (data) {
                    location.reload();
                },
                error: function() {
                    console.log("Error");
                }
            });
            
        } 

        let nonredirect = () => {
            $.ajax({
                type: 'POST',
                url: '{{route("non-redirect")}}',
                success: function (data) {
                    location.reload();
                },
                error: function() {
                    console.log("Error");
                }
            });
        }
        
        $(document).ready(function () {
          var table = $('.testimonial').DataTable({
              rowCallback: function(row, data, index){
                $(row).find('td').css('vertical-align', 'middle');
              },
              scrollX: true,
              destroy: true,
              processing: true,
              serverSide: true,
              ajax: {
                url: "{{ route('withdrawal-bonus.index') }}", 
              },
              lengthMenu: [[100, 250, 500, 1000, -1], [100, 250, 500, 1000, "All"]],
              columns: [
                  { data: 'DT_RowIndex', name: 'DT_RowIndex', className: "text-center", orderable: false, searchable: false },
                  { data: 'fullname', name: 'first_name', className: "text-center" },                                 
                  { data: 'username', name: 'username', className: "text-center" },
                  { data: 'no_rec', name: 'no_rec', className: "text-center" },                     
                  { data: 'bank_name', name: 'bank_name', className: "text-center" },                  
                  { data: 'npwp_number', name: 'npwp_number', className: "text-center" },                  
                  { data: 'bonusSponsor', name: 'bonus_sponsor', className: "text-center", orderable: false, searchable: false  },                  
                  { data: 'bonusPairing', name: 'bonus_pairing', className: "text-center", orderable: false, searchable: false  },                  
                  { data: 'bonusProfit', name: 'bonus_profit', className: "text-center", orderable: false, searchable: false  },                  
                  { data: 'bonusReward', name: 'bonus_reward', className: "text-center", orderable: false, searchable: false  },                  
                  { data: 'verificationStatus', name: 'verificationStatus', className: "text-center", orderable: false, searchable: false  },                  
                  { data: 'bonusTotal', name: 'total_bonus', className: "text-center", orderable: false, searchable: false   },                  
                  { data: 'check', orderable: false, searchable:false, name:'id', className: "text-center" },             
              ]
          });
          
        });

        $(document).on('click', '#bulk_paid', function(){
            var id = [];
            if(confirm("Are you sure to set as paid this checked data ?"))
            {
                $('.member_checkbox:checked').each(function(){
                    id.push($(this).val());
                });
                if(id.length > 0)
                
                {
                    $.ajax({
                        url:"{{url('backoffice/withdrawal-bonus/masspaid')}}",
                        method:"get",
                        data:{id:id},
                        success:function(data)
                        {
                            window.location.href = "{{ route('withdrawal-bonus.index') }}";
                            // swal("Good job!", "You clicked the button!", "success");
                            // $('#member_table').DataTable().ajax.reload();
                        }
                    });
                }
                else
                {
                    alert("Please select atleast one checkbox");
                }
            }
        });

      </script>
      
@endsection
