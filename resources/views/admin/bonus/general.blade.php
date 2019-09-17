@extends('layouts/admin')
@section('title')
Income Member
@parent
@stop

@section('content')

<section class="content-header">
    <h1>Income Member</h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">Bonus</a>
        </li>
        <li class="active">Income Member</li>
    </ol>
</section>
    <section class="content">                
    <div class="row">
        <div class="col-md-12">
           
        <div class="portlet box primary" style="margin-top: 15px;">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="livicon" data-name="permissions" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Bonus Table
                    </div>
                </div>
                
                <div class="portlet-body flip-scroll">
                    <table id="sponsor" class="table data-table table-bordered table-striped table-condensed flip-content sponsor" >
                        <thead class="flip-content">
                            <tr>
                                <th>ID Member</th>
                                <th>Username</th>
                                <th>NPWP</th>
                                <th>NO REK</th>
                                <th>B Sponsor</th>
                                <th>B Pairing</th>
                                <th>B Profit</th>
                                <th>B Reward</th>
                                <th>Total</th>
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
    <style>
    .dataTables_length {
    position: absolute;
    margin-top: 10px;
    }
    .dt-buttons {
        margin-left: 5px;
    }
    .dataTables_info {
        display : none;
    }
    #transaction_filter {
        margin-bottom : 15px;
    }
    </style>
    <script src="{{ asset('https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js') }}"></script>
    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js') }}"></script>
    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js') }}"></script>
    <script src="{{ asset('https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
          var table = $('.sponsor').DataTable({
              destroy: true,
              processing: true,
              serverSide: true,
              responsive: true,
              dom: 'Blfrtip',
              buttons: [
                {
                    extend: 'csv',
                    title: 'Membership',
                    orientation: 'landscape',
                    filename: 'membership'
                }, 
                {
                    extend: 'excel',
                    title: 'Membership',
                    filename: 'membership'
                }, 
                {
                extend: 'print',
                orientation: 'landscape',
                title: 'Membership',
                }
              ],
              ajax: {
                url: "{{ route('bonus.general') }}", 
              },
              columns: [
                  {data: 'id_member', name: 'id_member', className: 'text-center'},
                  {data: 'username', name: 'username', className: 'text-center'},
                  {data: 'npwp_number', name: 'npwp_number', className: 'text-center'},
                  {data: 'no_rec', name: 'no_rec', className: 'text-center'},
                  {data: 'bonus_sponsor', name: 'bonus_sponsor', className: 'text-center'},
                  {data: 'bonus_pairing', name: 'bonus_pairing', className: 'text-center'},
                  {data: 'bonus_profit', name: 'bonus_profit', className: 'text-center'},
                  {data: 'bonus_reward', name: 'bonus_reward', className: 'text-center'},
                  {data: 'total_bonus', name: 'total_bonus', className: 'text-center'},
              ]
          });
          $(".transaction_wrapper > .dt-buttons").appendTo("div.panel-heading");
    });
      </script>

@stop
