@extends('layouts/admin')
@section('title')
List Of Report Birthdate
@parent
@stop

@section('content')

<?php $n = 2;
 
    // menentukan timestamp 10 hari berikutnya dari tanggal hari ini
    $nextN = mktime(0, 0, 0, date("m"), date("d") + $n, date("Y"));

    $tgl_until = date('d-m-Y',$nextN);
    $tgl_now = date('d-m-Y'); 
?>

<section class="content-header">
    <h1>Report Birthdate</h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">Birthdate</a>
        </li>
        <li class="active">Report Birthdate</li>
    </ol>
</section>
    <section class="content">                
    <div class="row">
        <div class="col-md-12">
           
        <div class="portlet box primary" style="margin-top: 15px;">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="livicon" data-name="permissions" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Report Birthdate Table <b>({{$tgl_now}} s/d {{$tgl_until}})</b>
                    </div>

                    <!-- <div class="pull-right">
                        <a style=" color: white; text-decoration: none !important" onMouseOut="this.style.color='white'" onMouseOver="this.style.color='#f06262'"  href="{{ route('report.export') }}" target="_blank" data-toggle="modal"><i style="font-size:15px;" class="fa fa-file-excel-o"></i>&nbsp; &nbsp;<strong>Export Excel</strong></a>
                    </div> -->
                </div>




                <!-- <br/>
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
                 <br/> -->
                
                <div class="portlet-body flip-scroll">
                    <table id="transaction" class="table data-table table-bordered table-striped table-condensed flip-content transaction" >
                        <thead class="flip-content">
                            <tr>
                                <th>#</th>
                                <th>Id Member</th>
                                <th>Username</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Birthdate</th>
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

            function load_data()
            {
                $('.transaction').DataTable({
                    destroy: true,
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('report.birthdate') }}",
                        // data:{from_date:from_date, to_date:to_date}
                    },
                    columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', className: "text-center", orderable: false, searchable: false },
                        {data: 'id_member', name: 'id_member', className: 'text-center'},
                        {data: 'username', name: 'username', className: 'text-center'},
                        {data: 'name', name: 'name', className: 'text-center'},
                        {data: 'email', name: 'email', className: 'text-center'},
                        {data: 'birthdate', name: 'birthdate', className: 'text-center'}
                        // {data: 'member.username', name: 'member.username', className: 'text-center', orderable: false},
                        // {data: 'starterpackType', name: 'starterpackType', className: 'text-center'},
                        // {data: 'ebook.title', name: 'ebook.title', className: 'text-center'},
                        // {data: 'ebook.price', name: 'ebook.price', className: 'text-center'},
                        // {data: 'created_at', name: 'created_at', className: 'text-center'},
                        // {data: 'expired_at', name: 'expired_at', className: 'text-center'},
                    ]
                });
            }

            // $('#filter').click(function(){
            //     var from_date = $('#from_date').val();
            //     var to_date = $('#to_date').val();
            //     if(from_date != '' &&  to_date != '')
            //         {
            //             $('.transaction').DataTable().destroy();
            //             load_data(from_date, to_date);
            //         }
            //         else
            //         {
            //             alert('Both Date is required');
            //         }
            // });

            // $('#refresh').click(function(){
            //     $('#from_date').val('');
            //     $('#to_date').val('');
            //     $('.transaction').DataTable().destroy();
            //     load_data();
            // });

        });
    </script>

@stop
