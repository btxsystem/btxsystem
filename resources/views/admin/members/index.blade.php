@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
List Of Users
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link rel="stylesheet" href="{{ asset('assets/vendors/datatables/css/dataTables.bootstrap.css') }}" />
	<link href="{{ asset('assets/css/pages/tables.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <!-- end of page level css-->
@stop

{{-- Page content --}}
@section('content')

<section class="content-header">
    <!--section starts-->
    <h1>Users</h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">Admin Management</a>
        </li>
        <li class="active">Users</li>
    </ol>
</section>
<!--section ends-->
<section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN SAMPLE TABLE PORTLET-->
                        <a class="btn btn-large btn-primary" href="{{ route('admin.members.active.create') }}" data-toggle="modal"><i class="fa fa-plus" style="margin-right: 10px;"></i>Add</a>
                        <div class="portlet box primary" style="margin-top: 15px;">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="livicon" data-name="user" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                    Users Table
                                </div>
                            </div>
                            
                            <div class="portlet-body flip-scroll">
                                <table class="table data-table table-bordered table-striped table-condensed flip-content" >
                                    <thead class="flip-content">
                                        <tr>
                                            <th>No</th>
                                            <th>Id Member</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>HP</th>
                                            <th>Rank</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- END SAMPLE TABLE PORTLET-->
                        <!-- BEGIN SAMPLE TABLE PORTLET-->
                    </div>
                </div>
            </section>

@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/jquery.dataTables.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.bootstrap.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.responsive.js') }}" ></script>
    <script src="{{ asset('assets/js/pages/table-responsive.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
          var table = $('.data-table').DataTable({
              destroy: true,
              processing: true,
              serverSide: true,
              ajax: {
                url: "{{ route('admin.members.active.index') }}", 
              },
              
              columns: [
                  {
                      data: 'DT_RowIndex', name: 'DT_RowIndex', 
                      orderable: false, searchable: false
                  },
                  {data: 'id_member', name: 'id_member'},
                  {data: 'name', name: 'name'},
                  {data: 'status', name: 'status', searchable: false},
                  {data: 'hp', name: 'hp'},
                  {data: 'rank', name: 'rank', searchable: false},
                  {data: 'action', name: 'action', orderable: false, searchable: false},
                //  {data: 'email', name: 'email'},
                //  {data: 'action', name: 'action', orderable: false, searchable: false},
              ]
          });
          
        });
      </script>
@stop
