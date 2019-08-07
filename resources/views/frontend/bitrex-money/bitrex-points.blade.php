@extends('frontend.default')
@section('content')
<div class="modal fade" id="topup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="topup">Top Up Bitrex Points</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/action_page.php">
                <div class="form-group form-float col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-line">
                        <input class="form-control" id="nominal" type="number" min="5">
                        <label class="form-label">Nominal</label>
                    </div>
                </div>
                <div class="form-group form-float col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-line">
                        <input class="form-control" id="points" type="text" readonly>
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                <a href="#" class="btn btn-primary">Topup</a>
            </div>
            </div>
        </div>
    </div>
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
                                <a href="#" class="btn btn-primary btn-md" data-toggle="modal" data-target="#topup">Topup</a>
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
    $('#nominal').change(function(){
        var points = $('#nominal').val() / 1000; 
        $('#points').val(points);
    })
    $('#nominal').keydown(function(){
        var points = $('#nominal').val() / 1000; 
        $('#points').val(points);
    })
</script>
@stop