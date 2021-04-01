

@if(session('success'))
<div class="alert alert-success">
    {{session('success')}}
</div>

@endif

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">
            {{$error}}
        </div>

    @endforeach

@endif

@if (session('status'))
<div class="mb-4 font-medium text-sm alert alert-success">
    {{ session('status') }}
</div>
@endif
