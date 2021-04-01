@extends('admin.layout')
@section('main')
  <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Show Message</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{url('dashboard/messages')}}">Messages</a></li>
                        <li class="breadcrumb-item active"> {{$message->name}} Message</li>
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

                    <!-- table-->
                        <div class="col-12">
                            <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Message</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">

                                <tbody>

                                        <tr>
                                            <th>Name</th>
                                            <td>{{$message->name}}</td>
                                        </tr>
                                        <tr>
                                            <th>Eamil</th>
                                            <td>{{$message->email}}</td>
                                        </tr>
                                        <tr>
                                            <th>Name</th>
                                            <td>{{$message->subject ?? '....'}}</td>
                                        </tr>
                                        <tr>
                                            <th>Body</th>
                                                <td>
                                                    <textarea class="form-control" readonly rows="4" >{{$message->body}}</textarea>
                                                </td>
                                        </tr>
                                </tbody>
                                </table>



                            </div>
                            <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    <!-- /table-->
                    </div>
                    <div class="pb-2">
                    <div class="card" >
                        <div class="card-header">
                            <h3 class="card-title">Response</h3>
                        </div>
                        <div class="card-body p-0">
                            @include('admin.inc.errors')
                        <form method="POST" action="{{url('dashboard/messages/response',$message->id)}}">
                            @csrf

                            <div class="card-body">
                                <div class="form-group">
                                    <label >Title</label>
                                    <input type="text" class="form-control" name="title"  >
                                </div>
                                <div class="form-group">
                                    <label >Body</label>
                                    <textarea class="form-control" name="body" rows="4" ></textarea>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-warning ">Submit</button>
                                    <a href=" {{url()->previous()}}" class="btn btn-info ">Back</a>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </form>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            <!-- /.container-fluid -->
            </div>
            <!-- /.content -->
            </div>
    </div>

@endsection

