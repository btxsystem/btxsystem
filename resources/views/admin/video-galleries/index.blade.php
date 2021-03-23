@extends('layouts.admin')

@section('title')
List Of Gallery Videos
@parent
@stop

@section('content')

<section class="content-header">
    <h1>Gallery </h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">Gallery Videos</a>
        </li>
        <li class="active">Gallery Videos </li>
    </ol>
</section>
<section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN SAMPLE TABLE PORTLET-->
                        <a class="btn btn-large btn-primary" href="{{ route('galeries.create') }}"></i>Add</a>
                        <div class="portlet box primary" style="margin-top: 15px;">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="livicon" data-name="notebook" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                    Video  Table
                                </div>
                            </div>

                            <div class="portlet-body flip-scroll">
                                <table class="table data-table table-bordered table-striped table-condensed flip-content" >
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
            <form id="delete-form" action="" method="POST" style="display:none;">
                @csrf
                {{ method_field('DELETE') }}
                <button type="submit"></button>
            </form>


@stop

@section('footer_scripts')
    <script type="text/javascript">
        $(document).ready(function () {
          var table = $('.data-table').DataTable({
              destroy: true,
              processing: true,
              serverSide: true,
              ajax: {
                url: "{{ route('galeries.index') }}",
              },

              columns: [
                  { data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false },
                  { data: 'title', name: 'title' },
                  { data: 'action', name: 'action', orderable: false, searchable: false, className: "text-center" },
              ]
          });

        });
        function deleteVideo(id) {
                var result = confirm("are you sure delete this data ?")
                if (result) {
                    event.preventDefault();
                    $('#delete-form').attr("action", window.location.href + '/' + id);
                    $('#delete-form').submit();
                }
            }
      </script>

@endsection
