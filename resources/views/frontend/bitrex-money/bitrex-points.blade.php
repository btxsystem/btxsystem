@extends('frontend.default')
@section('content')
<section class="content ecommerce-page">
    
        <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="card">
                            <div class="header">
                                <h2> Bitrex Points History </h2>
                                <ul class="header-dropdown">
                                    <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more-vert"></i> </a>
                                        <ul class="dropdown-menu pull-right">
                                            <li><a href="javascript:void(0);">Action</a></li>
                                            <li><a href="javascript:void(0);">Another action</a></li>
                                            <li><a href="javascript:void(0);">Something else here</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="body">
                                <a href="#" class="btn btn-primary">Topup</a>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable points">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Description</th>
                                                <th>Nominal</th>
                                                <th>Points</th>
                                                <th>Info</th>
                                                <th>Transaction Date</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Bitrex Points History</th>
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
            url: "{{ route('member.bitrex-money.bitrex-points') }}", 
          },
          columns: [
              {
                  data: 'DT_RowIndex', name: 'DT_RowIndex', 
                  orderable: false, searchable: false
              },
              {data: 'description', name: 'description'},
              {data: 'nominal', name: 'nominal'},
              {data: 'points', name: 'points'},
              {
                  data: 'info', name: 'info',
                  orderable: false, searchable: false
              },
              {
                  data: 'date', name: 'date',
                  orderable: false, searchable: false   
              },
          ]
      });
    });
</script>
@stop