@include('frontend.auth.header')
    @if ($data)
        @foreach ($data['event'] as $item)
            <div class="card" style="border: 1px solid #ccc; box-shadow: 1px 1px 3px 0px  rgba(0,0,0,0.3); margin:20px; padding:20px;">
                <div class="body">
                    <div class="row">
                        <div class="col-md-3">
                            <img src="{{$item->path}}"  alt="Logo" height="auto" width="190px">
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
    @endif
@include('frontend.auth.footer')
