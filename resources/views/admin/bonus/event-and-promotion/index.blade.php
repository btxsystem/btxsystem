@extends('layouts.admin')

@section('title')
List Of Event and Promotion
@parent
@stop

@section('content')

<section class="content-header">
    <h1>Event and Promotion</h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">Bonus</a>
        </li>
        <li class="active">Event and Promotion</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box primary" style="margin-top: 15px;">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="livicon" data-name="notebook" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Event and Promotion
                    </div>
                    <div class="pull-right">
                        <a style=" color: white; text-decoration: none; margin-right: 20px; !important" href=""><i style="font-size:15px;" class="fa fa-plus"></i>&nbsp; &nbsp;<strong>Gift Event</strong></a>
                    </div>
                </div>
                <div class="portlet-body flip-scroll">
                    <table class="table data-table table-bordered table-striped table-condensed flip-content" >
                        <thead class="flip-content">
                            <tr>
                                <th>No</th>
                                <th style="width:20%">Username</th>
                                <th style="width:30%;">Event</th>
                                <th>Nominal</th>
                                <th>Got Reward</th>
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
                url: "{{ route('bonus.event-and-promotion.index') }}", 
              },
              columns: [
                  { data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false },
                  { data: 'username', name: 'username' },
                  { data: 'description', name: 'description' }, 
                  { data: 'nominal', name: 'nominal' },
                  { data: 'created_at', name: 'created_at' },                 
              ]
          });
          
        });
       
    </script>
      
@endsection
