@extends('layouts.admin')

@section('title')
Create Chapter Lesson
@parent
@stop

@section('content')

<section class="content-header">
    <h1> Chapter Lesson</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('ebook.index') }}">Ebook </a>
        </li>
        <li>
            <a href="{{ route('ebook.show', $data->bookEbook->ebook_id) }}">{{optional($data->bookEbook)->ebook_title}} </a>
        </li>
        <li>
            <a href="{{ route('book.index') }}">Book </a>
        </li>
        <li>
            <a href="{{ route('book.show', $data->id) }}">{{$data->title}} </a>
        </li>
        <li class="active">Create Lesson</li>
    </ol>

    <div class="container">
            <table class="table table-striped">
               <tbody>
                  <tr>
                     <td colspan="1">
                        <form class="well form-horizontal" method="post" action="{{route('book-chapter-lesson.store')}}">
                            {{ csrf_field() }}
                           <fieldset>
                           <input type="hidden" id="book_id" name="book_id" value="{{$data->id}}">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Title</label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                        <input id="title" name="title" placeholder="Title" class="form-control" required="true" value="{{old('title')}}" type="text">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Content</label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                        <textarea id="content" name="content" class="content"></textarea>
                                    </div>
                                </div>
                            </div>



                            <div class="form-group">
                                <label class="col-md-2 control-label"></label>
                                <div class="col-md-8 inputGroupContainer">                                
                                       <button type="submit" class="btn btn-primary btn-block">Submit</button>
                                </div>
                            </div>
                                                            
                           </fieldset>
                        </form>
                     </td>
                  </tr>
               </tbody>
            </table>
         </div>
</section>
<!--section ends-->
<section class="content">

@stop

@section('footer_scripts')
<script src="/editor/ckeditor/ckeditor.js"></script>  
    <script>
        CKEDITOR.replace( 'content',{
            width: "710px",
            height: "350px",
        }); 
        $("form").submit( function(e) {
            var messageLength = CKEDITOR.instances['content'].getData().replace(/<[^>]*>/gi, '').length;
            if( !messageLength ) {
                swal({
                    title: "Content need to filled !!",
                    type: "warning",

                });
                e.preventDefault();
            }
        }); 
    </script>
@stop
