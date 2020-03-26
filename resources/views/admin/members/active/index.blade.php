@extends('layouts.admin')

@section('title')
List Of Users Active
@parent
@stop

@section('content')

<section class="content-header">
    <h1>Users Active</h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">Members</a>
        </li>
        <li class="active">Users Active</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN SAMPLE TABLE PORTLET-->
            @if(\Auth::guard('admin')->user()->hasPermission('Members.add'))
                <a class="btn btn-large btn-primary" href="{{ route('members.create-data') }}" data-toggle="modal"><i class="fa fa-plus" style="margin-right: 10px;"></i>Add</a>
            @endif
            <!-- @if(\Auth::guard('admin')->user()->hasPermission('Members.add')) -->
            <!-- <button type="button" class="btn btn-large btn-success" data-toggle="modal" data-target="#myModal" id="open"><i class="fa fa-download" style="margin-right: 10px;"></i>Export</button> -->
                <!-- <a class="btn btn-large btn-success" href="{{ route('members.export-data') }}" target="_blank" data-toggle="modal"><i class="fa fa-download" style="margin-right: 10px;"></i>Export</a> -->
                <a class="btn btn-large btn-success link-export"><i class="fa fa-download" style="margin-right: 10px;"></i>Export</a>

            <!-- @endif -->
            <div class="portlet box primary" style="margin-top: 15px;">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="livicon" data-name="user" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Users Active Table
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
                    <table id="active-member" class="table membership-table table-bordered table-striped table-condensed flip-content" >
                        <thead class="flip-content">
                            <tr>
                                <th class="text-center" width="2%">No</th>
                                <th class="text-center" width="13%">Id Member</th>
                                <th class="text-center" width="10%">Username</th>
                                <th class="text-center" width="12%">Name</th>                                 <th class="text-center" width="10%">Sponsor</th>
                                <th class="text-center" width="8%">Join Date</th>
                                <th class="text-center" width="8%">Achieve Rank</th>
                                <th class="text-center" width="8%">Rank</th>
                                <th class="text-center" width="15%" class="action">Action</th>
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
<!-- Modal -->
  <div class="modal" tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="alert alert-danger" style="display:none"></div>
      <div class="modal-header">

        <h5 class="modal-title">Export Member To Excel or Csv</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="align-content: center">
        <div class="row input-daterange">
            <div class="col-md-4">
                <input type="text" name="from_date" id="from_date" class="form-control"  placeholder="From Date" readonly />
            </div>
            <div class="col-md-4">
                <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" readonly />
            </div>
            <div class="col-md-4">
                <div class="pull-left">
                    <button type="button" name="filter" id="filter" style="width: 100px;" class="btn btn-success"><i class="fa fa-download"></i> Excel</button><br><br>
                    <button type="button" name="refresh" id="refresh" style="width: 100px;" class="btn btn-success"><i class="fa fa-download"></i> Csv</button>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button  class="btn btn-success" id="ajaxSubmit">Save changes</button> -->
        </div>
    </div>
  </div>
</div>

@stop

@section('footer_scripts')
    <!-- <script type="text/javascript">
        $(document).ready(function () {
          var table = $('#active-user').DataTable({
              destroy: true,
              processing: true,
              serverSide: true,
              ajax: {
                url: "{{ route('members.active.index') }}",
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

        let direct = () => {
            $.ajax({
                type: 'POST',
                url: '{{route("redirect")}}',
                success: function (data) {
                    alert('success redirect website');
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
                    alert('success nonactive redirect website');
                },
                error: function() {
                    console.log("Error");
                }
            });
        }

        $(document).ready(function(){
            $('.input-daterange').datepicker({
                todayBtn:'linked',
                format:'yyyy-mm-dd',
                autoclose:true
            });

            load_data();

            function load_data(from_date = '', to_date = '')
            {
                $('#active-member').DataTable({
                    destroy: true,
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('members.active.index') }}",
                        data:{from_date:from_date, to_date:to_date}
                    },
                    columns: [
                        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                        { data: 'id_member', name: 'id_member'},
                        { data: 'username', name: 'username'},
                        { data: 'full_name', name: 'first_name'},
                        { data: 'sponsor', name: 'sponsor.username', orderable: false, searchable: false},
                        { data: 'join_at', name: 'join_at', orderable: false, searchable: false},
                        { data: 'lastArchive', name: 'lastArchive.created_at' , searchable: false},
                        { data: 'ranking', name: 'rank.name', orderable: false },
                        { data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center'},
                    ]
                });
            }

            $('#filter').click(function(){
                var from_date = $('#from_date').val();
                var to_date = $('#to_date').val();
                if(from_date != '' &&  to_date != '')
                    {
                        $('#active-member').DataTable().destroy();
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
                $('#active-member').DataTable().destroy();
                load_data();
            });


            $(document).on('click', '.nonactive-member', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                // console.log(id);
                var url =   "{{url('backoffice/members/active/nonactive/')}}"
                swal({
                            title: "Are you sure to set Non Active this member ?",
                            confirmButtonClass: "btn-danger",
                            confirmButtonText: "Yes!",
                            showCancelButton: true,
                        },
                        function() {
                            $.ajax({
                                type: "GET",
                                url: url +'/'+ id,
                                data: {id:id},
                                success: function (data) {
                                    // console.log(data);
                                        window.location.href = "{{ route('members.active.index') }}";
                                    }
                            });
                    });
            });
        });

        $(".link-export").click(function () {
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            var url = "{{ route('members.export-data') }}";
            if (from_date != '') {
                // alert(from_date);
                window.open(url + '?from=' + from_date + '&to=' + to_date, "_blank");
            } else {
                // alert('Kosong');
                window.open(url, "_blank");
            }
        });
    </script>
@stop
