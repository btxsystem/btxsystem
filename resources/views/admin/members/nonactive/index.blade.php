@extends('layouts.admin')

@section('title')
List Of Users Nonactive
@parent
@stop

@section('content')

<section class="content-header">
    <h1>Users Nonactive</h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">Members</a>
        </li>
        <li class="active">Users Nonactive</li>
    </ol>
</section>
<!--section ends-->
<section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN SAMPLE TABLE PORTLET-->
                        <div class="portlet box primary" style="margin-top: 15px;">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="livicon" data-name="user" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                    Users Nonactive Table
                                </div>
                            </div>

                            <br/>
                                    <div class="row input-daterange">
                                            <div class="col-md-5">
                                                <input type="text" name="from_date" id="from_date" class="form-control"  placeholder="From Date" readonly />
                                            </div>
                                            <div class="col-md-5">
                                                <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" readonly />
                                            </div>
                                            <div class="col-md-2">
                                                <div class="pull-right">
                                                    <button type="button" name="filter" id="filter" style="width: 50px;" class="btn btn-success"><i class="fa fa-search"></i></button> &nbsp;
                                                    <button type="button" name="refresh" id="refresh" style="width: 50px;" class="btn btn-default"><i class="fa fa-refresh"></i></button>
                                                </div>
                                            </div>
                        
                                    </div>
                             <br/>
                            
                            <div class="portlet-body flip-scroll">
                                <table id="nonactive-member"  class="table data-table table-bordered table-striped table-condensed flip-content nonactive-user" >
                                    <thead class="flip-content">
                                        <tr>
                                            <th class="text-center" width="5%">No</th>
                                            <th class="text-center" width="15%">Id Member</th>
                                            <th class="text-center" width="10%">Username</th>
                                            <th class="text-center" width="20%">Name</th>
                                            <th class="text-center" width="15%">Join Date</th>
                                            <th class="text-center" width="15%">Rank</th>
                                            <th class="text-center" width="15%">Action</th>
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

{{-- page level scripts --}}
@section('footer_scripts')
    <!-- <script type="text/javascript">
    
    $(document).ready(function () {
          var table = $('.nonactive-user').DataTable({
              destroy: true,
              processing: true,
              serverSide: false,
              ajax: {
                url: "{{ route('members.nonactive.index') }}", 
              },
              
              columns: [
                  {
                      data: 'DT_RowIndex', name: 'DT_RowIndex', 
                      orderable: false, searchable: false
                  },
                  {data: 'id_member', name: 'id_member'},
                  {data: 'username', name: 'username'},
                  {data: 'full_name', name: 'last_name'},
                  {data: 'created_at', name: 'created_at'},
                  {data: 'ranking', name: 'rank.name'},
                  {data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center'},
              ]
          });
          
        });
    </script> -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.input-daterange').datepicker({
                todayBtn:'linked',
                format:'yyyy-mm-dd',
                autoclose:true
            });

            load_data();

            function load_data(from_date = '', to_date = '')
            {
                $('#nonactive-member').DataTable({
                    destroy: true,
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('members.nonactive.index') }}",  
                        data:{from_date:from_date, to_date:to_date}
                    },
                    columns: [
                        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                        { data: 'id_member', name: 'id_member'},
                        { data: 'username', name: 'username'},
                        { data: 'full_name', name: 'last_name'},
                        { data: 'created_at', name: 'created_at'},
                        { data: 'ranking', name: 'rank.name', orderable: false, },
                        { data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center'},
                    ]
                });
            }

            $('#filter').click(function(){
                var from_date = $('#from_date').val();
                var to_date = $('#to_date').val();
                if(from_date != '' &&  to_date != '')
                    {
                        $('#nonactive-member').DataTable().destroy();
                        load_data(from_date, to_date);
                    }
                    else
                    {
                        alert('Both Date is required');
                    }
            });

            $('#refresh').click(function(){
                $('#from_date').val('');
                $('#to_date').val('');
                $('#nonactive-member').DataTable().destroy();
                load_data();
            });

        });
    </script>
@stop
