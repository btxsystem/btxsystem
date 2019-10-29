@extends('layouts.admin')

@section('title')
List Of Our Product
@parent
@stop

@section('content')

<section class="content-header">
    <h1>Book </h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">CMS</a>
        </li>
        <li class="active">List Our Product </li>
    </ol>
</section>
<section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN SAMPLE TABLE PORTLET-->
                        <!-- <a class="btn btn-large btn-primary" href="{{ route('ebook.create') }}"></i>Add</a> -->
                        <div class="portlet box primary" style="margin-top: 15px;">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="livicon" data-name="notebook" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                    Our Product  Table
                                </div>

                                <div class="pull-right">
                                    @if(\Auth::guard('admin')->user()->hasPermission('Cms.our_product.add'))
                                        <a style=" color: white; text-decoration: none; margin-right: 20px; !important" href="{{ route('cms.our-products.create') }}"><i style="font-size:15px;" class="fa fa-plus"></i>&nbsp; &nbsp;<strong>Add New Data</strong></a>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="portlet-body flip-scroll">
                                <table class="table data-table table-bordered table-striped table-condensed flip-content our-product" >
                                    <thead class="flip-content">
                                        <tr>
                                            <th>No</th>
                                            <th class="text-center" width="60%">Title</th>
                                            <th width="30%">Action</th>
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
          var table = $('.our-product').DataTable({
              destroy: true,
              processing: true,
              serverSide: true,
              ajax: {
                url: "{{ route('cms.our-products.index') }}", 
              },
              
              columns: [
                  { data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false },
                  { data: 'title', name: 'title' },                  
                  { data: 'action', name: 'action', orderable: false, searchable: false, className: "text-center" },
              ]
          });
          
        });

        $(document).on('click', '.delete-ourProduct', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            var url =   "{{url('backoffice/cms/our-products/')}}"
            swal({
                    title: "Are you sure ?",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes!",
                    showCancelButton: true,
                },
                function() {
                    $.ajax({
                        type: "DELETE",
                        url: url +'/'+ id,
                        data: {id:id},
                        success: function (data) {
                                window.location.href = "{{ route('cms.our-products.index') }}";
                            }         
                    });
            });
        });
       
      </script>
      
@endsection
