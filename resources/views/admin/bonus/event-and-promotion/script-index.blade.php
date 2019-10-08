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