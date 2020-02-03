@extends('frontend.default')
@section('title')
    My Sponsor
    @parent
@stop
@section('content')
<section class="content ecommerce-page">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <h2>Team Analyzer</h2>
            </div>
        </div>
    </div>

    <!-- <div class="pull-right col-lg-3 col-md-3 col-sm-3 col-xs-3">
		<div class="form">
            <select data-column="2" class="form-control filter-select">
            <option value="">-- Select Rank --</option>
            <option value="-">No Rank</option>
             @foreach($ranks as $rank)
                <option value="{{$rank->name}}">{{$rank->name}}</option>
            @endforeach
			</select>
		</div>
    </div> -->
    &nbsp;
    <div class="col-lg-3 col-lg-offset-1  col-md-3 col-md-offset-1  col-sm-3 col-sm-offset-1 col-xs-3 col-xs-offset-1 ">
		<div class="form">
            <select data-column="4" class="form-control filter-select">
            <option value="">-- All Rank --</option>
            <option value="-">No Rank</option>
             @foreach($ranks as $rank)
                <option value="{{$rank->name}}">{{$rank->name}}</option>
            @endforeach
			</select>
		</div>
    </div>
    <form action="{{route('member.direct-tree')}}" method="POST" id="form-direct">
        @csrf
        <input type="hidden" id="username_value" name="username_value">
    </form>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12" id="bill">
                <table id="my-analizer" class="display nowrap" style="width:100%; font-size:15px">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Join Date</th>
                            <th>Rank</th>
                            <th>Achieve Rank</th>
                            <th>PV Left</th>
                            <th>PV Middle</th>
                            <th>PV Right</th>
                            <!-- <th>Parent ID</th> -->
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@stop

@section('footer_scripts')
    <style>
    .dropdown-toggle {
        display: none !important;
    }
    </style>
    <script type="text/javascript">
        $(document).ready(function () {
          $(document).on('click', '.direct_tree', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                $('#username_value').val(id);
                document.getElementById("form-direct").submit();
          });
          $('.filter-select').change(function() {
              console.log($(this).data('column'))
              table.column($(this).data('column'))
              .search($(this).val())
              .draw();
          });

          var table = $('#my-analizer').DataTable({
              destroy: true,
              processing: true,
              serverSide: true,
              ajax: {
                url: "{{ route('member.team-report.my-analizer') }}",
              },

              columns: [
                  { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                  { data: 'full_name', name: 'full_name'},
                  { data: 'username', name: 'username'},
                  { data: 'created_at', name: 'created_at'},
                  { data: 'ranking', name: 'ranking', className: "text-center" },
                  { data: 'archive_rank', name: 'archive_rank', className: "text-center" },
                  { data: 'pv_left', name: 'rankipv_leftng', className: "text-center"  },
                  { data: 'pv_middle', name: 'pv_middle', className: "text-center"  },
                  { data: 'pv_right', name: 'pv_right', className: "text-center"  },
              ]
          });

        });

      </script>

@endsection
