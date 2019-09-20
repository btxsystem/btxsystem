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
                            
                            <div class="portlet-body flip-scroll">
                                <table class="table data-table table-bordered table-striped table-condensed flip-content nonactive-user" >
                                    <thead class="flip-content">
                                        <tr>
                                            <th class="text-center" width="5%">No</th>
                                            <th class="text-center" width="15%">Id Member</th>
                                            <th class="text-center" width="10%">Username</th>
                                            <th class="text-center" width="20%">Name</th>
                                            <th class="text-center" width="20%">Join Date</th>
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
    <script type="text/javascript">
    
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
    </script>
@stop
