<br>
<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Name</th>
            <th class="text-center">Action</th>
        </tr>
        </thead>
            
             <tbody>
                @forelse($data->chapters as $chapter)
                <tr>
                    <td>{{$chapter->title}}</td>
                    <td class="text-center" width="15%">
                        <!-- <a href="#" class="text-blue" data-toggle="tooltip" data-placement="top" title="Show">
                            <i aria-hidden="true" class="fa fa-eye fa-lg"></i>
                        </a>                                            
                            &nbsp; &nbsp;
                        <a href="#" class="text-warning" data-toggle="tooltip" data-placement="top" title="Edit">
                            <i aria-hidden="true" class="fa fa-pencil-square-o fa-lg"></i>
                        </a> -->
                    
                        <a href="#" class="text-danger" data-toggle="tooltip" data-placement="top" title="Delete" onclick="destroyChapter({{ $loop->index + 1 }})">
                            <i aria-hidden="true" class="fa fa-trash-o fa-lg"></i>
                        </a>
                            <form method="post" action="{{route('book-chapter.destroy', $chapter->id)}}" style="display: none" id="{{ $loop->index + 1 }}">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                            </form>
                     </td>
                </tr>
                @empty
                <tr>
                    <td colspan="2" class="text-center">
                        Empty Data
                    </td>
                </tr>
                @endforelse
            </tbody>
    </table>
</div>

{{-- page level scripts --}}
@section('footer_scripts')
    <script type="text/javascript">
        function destroyChapter(id) {
            swal({
                icon: 'warning',
                text: 'Are you sure you want to delete this Attachment?',
                buttons: ["No", "Yes"],
                dangerMode: true,
            })
                .then(isClose => {
                    if (isClose) {
                        $(`#${id}`).submit();
                        swal("Attachment deleted successfully",{icon: "success"});
                    } else {
                        swal("Attachment Bank canceled");
                     }
                 });
        }
    </script>
@stop
