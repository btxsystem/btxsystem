@extends('layouts.admin')

@section('title')
Detail Book
@parent
@stop

@section('content')

<section class="content-header">
    <h1> Book</h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">Book Management</a>
        </li>
        <li class="active">Detail Data Book</li>
    </ol>

    <div class="container">
            <table class="table table-striped">
               <tbody>
                  <tr>
                  <td colspan="1">
                    <div class="well form-horizontal">
                     <fieldset>
                         <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <label class="control-label">Title &nbsp; :</label>
                                <div class="">
                                    <p class="form-control-static">
                                        {{$data->title}}
                                    </p>
                                </div>
                            </div>   

                            <div class="form-group">
                                <label class="control-label">Article &nbsp; :</label>
                                <div class="">
                                    <p class="form-control-static">
                                        {!! $data->article !!}
                                    </p>
                                </div>
                            </div>                       
                          </div>
                     </fieldset>
                    </div>
                    </td>
                  </tr>
               </tbody>
            </table>
     </div>
</section>
<!--section ends-->
<section class="content">

@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script type="text/javascript">

       
      </script>
@stop
