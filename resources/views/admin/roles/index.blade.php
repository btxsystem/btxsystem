@extends('layouts.admin')
@section('title')
List Of Roles
@parent
@stop
@section('content')
<section class="content-header">
    <h1>Roles</h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">Admin Management</a>
        </li>
        <li class="active">Roles</li>
    </ol>
</section>
<section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <a class="btn btn-primary" href="{{ route('admin.admin-management.roles.create')}}"><i class="fa fa-plus" style="margin-right: 10px;"></i>Add</a>
                        <div class="portlet box primary" style="margin-top: 15px;">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="livicon" data-name="permissions" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                    Roles Table
                                </div>
                            </div>
                            
                            <div class="portlet-body flip-scroll">
                                <table class="table data-table table-bordered table-striped table-condensed flip-content" >
                                    <thead class="flip-content">
                                        <tr>
                                            <th>No</th>
                                            <th>Title</th>
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
                url: "{{ route('admin.admin-management.roles.index') }}", 
              },
              
              columns: [
                  {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                  {data: 'title', name: 'title'},
                  {data: 'action', name: 'action'},
              ]
          });
          
        });
      </script>
@stop
