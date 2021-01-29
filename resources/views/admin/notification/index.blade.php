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
                            <div>
                                <button onclick="readAll()" class="btn btn-success">Read All</button>
                                <button onclick="unreadAll()" class="btn btn-warning">Unread All</button>
                                <button onclick="deleteAll()" class="btn btn-danger">Delete All</button>
                            </div>
                            <br/>
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
        var table = null
        $(document).ready(function () {
        table = $('.data-table').DataTable({
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

        function deleteNotif(id = 0) {
        swal({
                title: "Are you sure delete this data?",
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes!",
                showCancelButton: true,
            },
            function() {
                $.ajax({
                    type: 'GET', //THIS NEEDS TO BE GET
                    url: 'notification/delete/'+id,
                    success: function (data) {
                        table.ajax.reload();                       
                    }
                })
            });
        }

        function deleteAll() {
        swal({
                title: "Are you sure delete all data?",
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes!",
                showCancelButton: true,
            },
            function() {
                $.ajax({
                    type: 'GET', //THIS NEEDS TO BE GET
                    url: 'notification/deletes',
                    success: function (data) {
                        table.ajax.reload();                       
                    }
                })
            });
        }

        function readAll() {
        swal({
                title: "Are you sure read all data?",
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes!",
                showCancelButton: true,
            },
            function() {
                $.ajax({
                    type: 'GET', //THIS NEEDS TO BE GET
                    url: 'notification/reads',
                    success: function (data) {
                        table.ajax.reload();                       
                    }
                })
            });
        }

        function unreadAll() {
        swal({
                title: "Are you sure unread all data?",
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes!",
                showCancelButton: true,
            },
            function() {
                $.ajax({
                    type: 'GET', //THIS NEEDS TO BE GET
                    url: 'notification/unreads',
                    success: function (data) {
                        table.ajax.reload();                       
                    }
                })
            });
        }

        let readNotification = (id) => {
            $.ajax({
                type: 'GET', //THIS NEEDS TO BE GET
                url: 'notification/read/'+id,
                success: function (data) {
                    table.ajax.reload();                       
                }
            })
        }
    </script>
@stop
