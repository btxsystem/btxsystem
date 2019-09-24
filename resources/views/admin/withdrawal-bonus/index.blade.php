@extends('layouts.admin')

@section('title')
Withdrawal Bonus
@parent
@stop

@section('content')

<section class="content-header">
    <h1>Withdrawal Bonus </h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">Withdrawal Bonus</a>
        </li>
        <li class="active">Index</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box primary" style="margin-top: 15px;">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="livicon" data-name="notebook" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Withdrawal Bonus  Table
                    </div>
<!-- 
                    <div class="pull-right">
                        <a style=" color: white; text-decoration: none !important" href="#addTestimoniModal" data-toggle="modal"><i style="font-size:15px;" class="fa fa-plus"></i>&nbsp; &nbsp;<strong>Add New Testimony</strong></a>
                    </div> -->
                </div>
                
                <div class="portlet-body flip-scroll">
                    <table id="member_table"  class="table data-table table-bordered table-striped table-condensed flip-content testimonial" >
                        <thead class="flip-content">
                            <tr>
                                <th class="text-center" width="5%">No</th>
                                <th class="text-center" width="15%">ID Member</th>
                                <th class="text-center" width="15%">Username</th>
                                <th class="text-center" width="10%">B Sponsor</th>
                                <th class="text-center" width="10%">B Pairing</th>
                                <th class="text-center" width="10%">B Profit</th>
                                <th class="text-center" width="10%">B Reward</th>
                                <th class="text-center" width="15%">Bitrax Cash</th>
                                <th class="text-center" width="10%"><button type="button" name="bulk_paid" id="bulk_paid" class="btn btn-danger btn-xs">Paid Checked</button></th>
                                <!-- <th width="15%">Action</th> -->
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
        $(document).ready(function () {
          var table = $('.testimonial').DataTable({
              rowCallback: function(row, data, index){
                $(row).find('td').css('vertical-align', 'middle');
              },
              destroy: true,
              processing: true,
              serverSide: true,
              ajax: {
                url: "{{ route('withdrawal-bonus.index') }}", 
              },
              columns: [
                  { data: 'DT_RowIndex', name: 'DT_RowIndex', className: "text-center", orderable: false, searchable: false },
                  { data: 'id_member', name: 'id_member', className: "text-center" },                  
                  { data: 'username', name: 'username', className: "text-center" },                  
                  { data: 'bonusSponsor', name: 'bonus_sponsor', className: "text-center", orderable: false, searchable: false  },                  
                  { data: 'bonusPairing', name: 'bonus_pairing', className: "text-center", orderable: false, searchable: false  },                  
                  { data: 'bonusProfit', name: 'bonus_profit', className: "text-center", orderable: false, searchable: false  },                  
                  { data: 'bonusReward', name: 'bonus_reward', className: "text-center", orderable: false, searchable: false  },                  
                  { data: 'cash', name: 'bitrex_cash', className: "text-center" },                  
                //   { data: 'expired_at', name: 'expired_at', className: "text-center" },     
                  { data: 'check', orderable: false, searchable:false, name:'id', className: "text-center" },             
                //   { data: 'action', name: 'action', orderable: false, searchable: false, className: "text-center" },
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
