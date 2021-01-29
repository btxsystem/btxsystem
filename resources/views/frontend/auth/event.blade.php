@include('frontend.auth.header')
    <div>
        <center><h1>Event and promotion</h1></center>
    </div>
    <hr>
    @if (count($data['event'])>0)
        @foreach ($data['event'] as $item)
            <div class="card" style="border: 1px solid #ccc; box-shadow: 1px 1px 3px 0px  rgba(0,0,0,0.3); margin:20px; padding:20px;">
                <div class="body">
                    <div class="row">
                        <div class="col-md-3">
                            <img src="{{$item->path}}"  alt="Logo" height="200px" width="200px">
                        </div>
                        <div class="col-md-9">
                            <h2>{{$item->name}}</h2>
                            <hr>
                            <p>{{$item->desc}}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div>
            <center><h4>Sorry Event and promotion are empty</h4></center>
        </div>
        <br>
    @endif
@include('frontend.auth.footer')
