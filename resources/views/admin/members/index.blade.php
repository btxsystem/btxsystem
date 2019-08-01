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
            <a href="#">Admin Management</a>
        </li>
        <li class="active">Users Active</li>
    </ol>
</section>
<section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN SAMPLE TABLE PORTLET-->
                        <a class="btn btn-large btn-primary" href="{{ route('admin.members.active.create') }}" data-toggle="modal"><i class="fa fa-plus" style="margin-right: 10px;"></i>Add</a>
                        <div class="portlet box primary" style="margin-top: 15px;">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="livicon" data-name="user" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                    Users Active Table
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
                    </div>
                </div>
            </section>

@stop

@section('footer_scripts')
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
              ]
          });
          
        });
      </script>
@stop
