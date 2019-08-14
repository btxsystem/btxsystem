@extends('frontend.default')
@section('title')
    Pv
    @parent
@stop
@section('content')
<section class="content ecommerce-page">
        <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="card">
                            <div class="header">
                                <h2> PV History </h2>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable points">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Pv Income</th>
                                                <th>Total Pv</th>
                                                <th>Transaction Date</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>PV History</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

</section>
@stop

@section('footer_scripts')  
<script type="text/javascript">
    $(document).ready(function () {
      var table = $('.points').DataTable({
          destroy: true,
          processing: true,
          serverSide: true,
          ajax: {
            url: "{{ route('member.bitrex-money.pv') }}", 
          },
          columns: [
              {
                  data: 'DT_RowIndex', name: 'DT_RowIndex', 
                  orderable: false, searchable: false
              },
              {data: 'pv_today', name: 'pv_today'},
              {data: 'pv', name: 'pv'},
              {
                  data: 'date', name: 'date',
                  orderable: false, searchable: false   
              },
          ]
      });
    });
</script>
@stop