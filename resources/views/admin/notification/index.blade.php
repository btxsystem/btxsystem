@extends('layouts.admin')

{{-- Page title --}}
@section('title')
List Of Notifications
@parent
@stop

{{-- Page content --}}
@section('content')

<section class="content-header">
    <!--section starts-->
    <h1>Notifications</h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">Notification</a>
        </li>
        <li class="active">Notifications</li>
    </ol>
</section>
<!--section ends-->
<section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN SAMPLE TABLE PORTLET-->
                        <div class="portlet box primary">
                            <div class="portlet-body flip-scroll">
                                <table class="table data-table table-bordered table-striped table-condensed flip-content" >
                                    <thead class="flip-content">
                                        <tr>
                                            <th>No</th>
                                            <th>Username</th>
                                            <th>Messages</th>
                                            <th>Date</th>
                                            <th>Status</th>
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
    <script type="text/javascript">
        $(document).ready(function () {
          var table = $('.data-table').DataTable({
              destroy: true,
              processing: true,
              serverSide: true,
              ajax: {
                url: "{{ route('notification.data') }}",
              },

              columns: [
                  {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable:false, searchable:false},
                  {data: 'user.username', name: 'user.username'},
                  {data: 'desc', name: 'desc'},
                  {data: 'created_at', name: 'created_at'},
                  {data: 'isRead', name: 'isRead'},
              ]
          });

        });
    </script>
@stop
