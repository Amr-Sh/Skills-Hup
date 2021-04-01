
@if(session('msg'))
    <div class="alert alert-success">
        {{session('msg')}}
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger">
        {{session('error')}}
    </div>
@endif
