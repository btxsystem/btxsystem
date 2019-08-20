@extends('frontend.default')
@section('title')
    Prospected Member
    @parent
@stop
@section('content')
<section class="content ecommerce-page">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Prospected Member
                <small class="text-muted">Bitrexgo</small>
                </h2>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12" id="bill">
                <table id="example" class="display nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Number Phone</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Number Phone</th>
                        </tr>
                    </tfoot>
                </table> 
            </div>
        </div>
    </div>
</section>
@stop

@section('footer_scripts')  
<script type="text/javascript">
    $(document).ready(function() {
    var table = $('#example').DataTable( {
        destroy: true,
        processing: true,
        serverSide: true,
        responsive: true,
        "retrieve": true,
        ajax: {
            url: "{{ route('member.prospected-member') }}", 
        },
              
        columns: [
            {data: 'name', name: 'name', },
            {data: 'username', name: 'username'},
            {data: 'email', name: 'email'},
            {data: 'number_phone', name: 'number_phone', searchable: false},
            ],
        
            rowReorder: {
            selector: 'td:nth-child(2)'
        },
    } );
} );
</script>
@stop