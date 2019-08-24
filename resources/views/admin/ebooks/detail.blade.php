@extends('layouts.admin')

@section('title')
List Of {{$data->title}}
@parent
@stop

@section('content')

<section class="content-header">
    <h1>{{$data->title}} Overview </h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">Ebook </a>
        </li>
        <li class="active">{{$data->title}} </li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <a class="btn btn-large btn-primary" href="{{ route('book.create') }}"></i>Create Book</a>
            <div class="pull-right">
                <a class="btn btn-large btn-warning" href="{{ route('ebook.edit', $data->id) }}"><i class="fa fa-pencil"></i>&nbsp;Edit Data</a>
            </div>

            
            <div class="portlet box primary" style="margin-top: 15px;">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="livicon" data-name="notebook" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        {{$data->title}} Overview
                    </div>
                </div>
                  
                    <div class="col-md-3">
                        <br>
                        <div>
                            <label class="control-label">Pice &nbsp; : &nbsp; {{$data->title}} </label>
                        </div>  
                        <br>                              
                    </div>
                    <div class="col-md-3">
                        <br>
                        <div>
                            <label class="control-label">Markup Price &nbsp; : &nbsp; {{$data->price_markup}} </label>
                        </div>
                        <br>                                
                    </div>
                    <div class="col-md-3">
                        <br>
                        <div>
                            <label class="control-label">Point Value &nbsp; : &nbsp; {{$data->pv}} </label>
                        </div>
                        <br>                                
                    </div>
                    <div class="col-md-3">
                        <br>
                        <div>
                            <label class="control-label">Bonus Value &nbsp; : &nbsp; {{$data->bv}} </label>
                        </div>
                        <br>
                    </div>
     
        
                

            </div>

            <div class="portlet box primary" style="margin-top: 15px;">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="livicon" data-name="table" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        {{$data->title}} List
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

@stop

@section('footer_scripts')
    <script type="text/javascript">
        $(document).ready(function () {
          var table = $('.data-table').DataTable({
              destroy: true,
              processing: true,
              serverSide: true,
              ajax: {
                url: "{{ route('ebook.show', $data->id) }}", 
              },
              
              columns: [
                  { data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false },
                  { data: 'title', name: 'title' },                  
                  { data: 'action', name: 'action', orderable: false, searchable: false, className: "text-center" },
              ]
          });
          
        });
       
      </script>
      
@endsection
