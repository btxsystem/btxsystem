@extends('layouts/admin')
@section('title')
List Of Membership
@parent
@stop

@section('content')

<section class="content-header">
    <h1>Membership</h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">Report</a>
        </li>
        <li class="active">Membership</li>
    </ol>
</section>
    <section class="content">                
    <div class="row">
        <div class="col-md-12">
           
        <div class="portlet box primary" style="margin-top: 15px;">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="livicon" data-name="permissions" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Membership Table
                    </div>
                </div>
                
                <div class="portlet-body flip-scroll">
                    <table id="membership" class="table data-table table-bordered table-striped table-condensed flip-content membership" >
                        <thead class="flip-content">
                            <tr>
                                <th>Member ID</th>
                                <th>Username</th>
                                <th>Mobile Number</th>
                                <th>Rank</th>
                                <th>Expired</th>
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

  
    <!-- <div id="detail" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Detail transactions</h4>
                </div>
                <div class="modal-body">
                    <fieldset>
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="livicon" data-name="permissions" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                Bitrex Cash Table
                            </div>
                        </div>
                        
                        <div class="portlet-body flip-scroll">
                            <table class="table data-table table-bordered table-striped table-condensed flip-content detail" >
                                <thead class="flip-content">
                                    <tr>
                                        <th>No</th>
                                        <th>Id Member</th>
                                        <th>Nominal</th>
                                        <th>Description</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </fieldset>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div> -->
    </div>
    

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
          var table = $('.membership').DataTable({
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
                url: "{{ route('report.membership') }}", 
              },
              columns: [
                  {data: 'id_member', name: 'id_member', className: 'text-center'},
                  {data: 'username', name: 'username', className: 'text-center'},
                  {data: 'phone_number', name: 'phone_number', className: 'text-center'},
                  {data: 'rank', name: 'rank.name', className: 'text-center'},
                  {data: 'expired', name: 'expired_at', className: 'text-center'},
              ]
          });
          $(".transaction_wrapper > .dt-buttons").appendTo("div.panel-heading");
    });


    var detail = (id) => {
        console.log('masuk'); 
        var table = $('.detail').DataTable({
              destroy: true,
              processing: true,
              serverSide: true,
              ajax: {
                url: id+"/cash/detail"
              },
              columns: [
                  {
                      data: 'DT_RowIndex', name: 'DT_RowIndex', 
                      orderable: false, searchable: false
                  },
                  {data: 'nominal', name: 'nominal'},
                  {data: 'description', name: 'description', searchable: false},
                  {data: 'created_at', name: 'created_at', orderable: false, searchable: false},
              ]    
        });    
    };
      </script>

@stop
