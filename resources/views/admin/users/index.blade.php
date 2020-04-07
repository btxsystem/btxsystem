@extends('layouts.admin')
{{-- Page title --}}
@section('title')
List Of Users
@parent
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
                        
                        @if(\Auth::guard('admin')->user()->hasPermission('Admin_management.user_company.roles.add'))
                            <a href="{{ route('admin-management.users.create') }}" class="btn btn-primary"><i class="fa fa-plus" style="margin-right: 10px;"></i>Add</a>
                        @endif
                        <div class="portlet box primary" style="margin-top: 15px;">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="livicon" data-name="permissions" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                    Users Table
                                </div>
                            </div>
                            
                            <div class="portlet-body flip-scroll">
                                <table class="table data-table table-bordered table-striped table-condensed flip-content" >
                                    <thead class="flip-content">
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
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

            <form id="delete-form" action="" method="POST" style="display:none;">
                    @csrf
                    {{ method_field('DELETE') }}
                    <button type="submit"></button>
                </form>

@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script type="text/javascript">
        $(document).ready(function () {
          var table = $('.data-table').DataTable({
              destroy: true,
              processing: true,
              serverSide: true,
              ajax: {
                url: "{{ route('admin-management.users.index') }}", 
              },
              
              columns: [
                  {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                  {data: 'name', name: 'name'},
                  {data: 'email', name: 'email'},
                  {data: 'title', name: 'title', orderable: false},
                 {data: 'action', name: 'action', orderable: false, searchable: false},
                //  {data: 'email', name: 'email'},
              ]
          });
          
        });
      </script>
      <script>
        function deleteUser(id) {
            var result = confirm("are you sure delete this data ?")
            if (result) {
                event.preventDefault();
                $('#delete-form').attr("action", window.location.href + '/' + id);
                $('#delete-form').submit();
            }
        }
      </script>
@stop
