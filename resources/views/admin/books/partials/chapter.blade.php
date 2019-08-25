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
        
                        <a class="text-warning" data-toggle="modal" data-placement="top" title="Edit">
                            <i aria-hidden="true" data-id="{{$chapter->id}}"  class="fa fa-pencil-square-o fa-lg edit_chapter_modal"></i>
                        </a> 


                        <a href="#"
                            class="text-danger"
                            data-toggle="tooltip"
                            data-placement="top"
                            title="Delete"
                            onclick="destroyAttachment({{ $loop->index + 1 }})"
                        >
                            <i aria-hidden="true" class="fa fa-trash-o fa-lg"></i>
                        </a>
                        <form method="post"
                              action="{{route('book-chapter.destroy', $chapter->id)}}"
                              style="display: none"
                              id="{{ $loop->index + 1 }}"
                        >
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


<div id="editChapterModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Book Chapter</h4>
                </div>
                <div class="modal-body">
                    <form class="well form-horizontal" method="POST" action="{{url('backoffice/update-chapter/')}}"">
                                {{ csrf_field() }}
                        <fieldset>
                        <input id="chapter_id" name="chapter_id" type="hidden">
                        <input id="book_id" name="book_id" type="hidden">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Title</label>
                                <div class="col-md-9 inputGroupContainer">
                                    <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-piggy-bank"></i></span>
                                    <input id="title" name="title" placeholder="Title" class="form-control" required="true" value="" type="text">
                                </div>
                                </div>
                            </div>
                        </fieldset>
                        <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
</div>

{{-- page level scripts --}}
@section('footer_scripts')
    <script type="text/javascript">
        $(document).on('click','.edit_chapter_modal',function(){
   
            var id = $(this).data('id');
            var url =   "{{url('backoffice/book-chapter/')}}" +'/'+ id +'/edit';

            console.log(url);
            $.get(url, function (data) {
                //success data
                console.log(data);
                $('#chapter_id').val(data.id);
                $('#book_id').val(data.book_id);
                $('#title').val(data.title);

                $('#btn-save').val("update");
                $('#editChapterModal').modal('show');
            }) 
        });

        function destroyAttachment(id) {
            swal({
                    title: "Are you sure!",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes!",
                    showCancelButton: true,
                },
                function() {
                    $(`#${id}`).submit();
            });
        }
    </script>
@stop
