@extends('admin.layout')
@section('main')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{$exam->name('en')}} Questions</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{url('dashboard/exams')}}">Exams</a></li>
              <li class="breadcrumb-item"><a href="{{url('dashboard/exams/show/',$exam->id)}}">{{$exam->name('en')}} </a></li>
              <li class="breadcrumb-item active">Questions</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        @include('admin.inc.messages')
        <div class="row">
            <div class="col-12 pb-3">
            <!-- table-->
            {{-- <div class="col-12 pb-3"> --}}
                <div class="card">
         <!-- /.card-header -->
                    <div class="card-header">
                        <h3 class="card-title">Exam Questions</h3>
                        <div class="card-tools">
                            <a href="{{url('dashboard/exams/create')}}" class="btn btn-sm btn-primary"> Add new</a>
                        </div>
                    </div>
        <!-- /.card-header -->

        <div class="card-body table-responsive pb-0">
            <table class="table table-hover text-nowrap ">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Title</th>
                  <th>Options</th>
                  <th>Right answers</th>
                  <th>ِِActions</th>
                </tr>
              </thead>
                <tbody>
            @foreach($exam->questions as $ques)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$ques->title}}</td>
                    <td>
                        <ol>
                            <li>{{$ques->option_1}}</li>
                            <li>{{$ques->option_2}}</li>
                            <li>{{$ques->option_3}}</li>
                            <li>{{$ques->option_4}}</li>
                        </ol>
                    </td>
                    <td>{{$ques->right_ans}}</td>
                    <td>
                        <a href="{{url("dashboard/exams/edit-question/$exam->id/$ques->id")}}" class="btn btn-sm btn-info " >
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>

            </tr>
            @endforeach
                </tbody>
                <!-- /table-->
            </table>
        </div>
      <!-- /.card-body -->

    </div>

    <a href=" {{url()->previous()}}" class="btn btn-sm btn-primary ">Back</a>
    <a href=" {{url("dashboard/exams")}}" class="btn btn-sm btn-success ">Back to all exams</a>

   <!-- /.card -->
    </div>

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
