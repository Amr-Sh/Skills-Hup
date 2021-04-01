@extends('admin.layout')
@section('main')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit {{$ques->title}} </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{url('dashboard/exams')}}">Exams</a></li>
              <li class="breadcrumb-item"><a href="{{url('dashboard/exams/show/',$exam->id,)}}"> {{$exam->name('en')}} </a></li>
              <li class="breadcrumb-item"><a href="{{url('dashboard/exams/show/',$exam->id,'questions')}}">Questions </a></li>
              <li class="breadcrumb-item active">Edit</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-12 pb-3">
                @include('admin.inc.errors')
                <form  method="POST" action="{{url("dashboard/exams/update-question/$exam->id/$ques->id")}}">
                    @csrf
                <div class="card-body">

                        <h5>Question {{$ques->title}} </h5>

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label >title</label>
                            <input type="text" class="form-control" name="title" value="{{$ques->title}}"  >
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label >Right ans</label>
                            <input type="text" class="form-control" name="right_ans" min="1" max="4" value="{{$ques->right_ans}}" >
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label >option-1</label>
                            <input type="text" class="form-control" name="option_1" value="{{$ques->option_1}}" >
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label >option-2</label>
                            <input type="text" class="form-control" name="option_2" value="{{$ques->option_2}}" >
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label >option-3</label>
                            <input type="text" class="form-control" name="option_3" value="{{$ques->option_3}}">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label >option-4</label>
                            <input type="text" class="form-control" name="option_4" value="{{$ques->option_4}}">
                        </div>
                    </div>
                </div>
                    <hr>

                    <div>
                        <button type="submit" class="btn btn-sm btn-success ">Submit</button>
                        <a href=" {{url()->previous()}}" class="btn btn-sm btn-primary ">Back</a>
                    </div>
                    <!-- /.card-body -->
                </div>
            </form>

     </div>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
