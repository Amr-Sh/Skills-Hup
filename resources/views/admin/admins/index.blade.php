@extends('admin.layout')
@section('main')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">admins</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">admins</li>
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
                    <h3 class="card-title">admins</h3>

                     <div class="card-tools">
                        <a href=" {{url('dashboard/admins/create')}} "  class="btn btn-sm btn-primary" >
                            Add new
                        </a>

                    </div>

                  </div>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Name</th>
                          <th>Eamil</th>
                          <th>Role</th>
                          <th>Vrefied</th>
                          <th>Actions</th>

                        </tr>
                      </thead>
                      <tbody>
                          @foreach($admins as $admin)
                            <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$admin->name}}</td>
                            <td>{{$admin->email}}</td>
                            <td>{{$admin->role->name}}</td>
                             <td>
                                @if($admin->email_verified_at)
                                <span class="badge badge-success">yes</span>
                                @else
                                <span class="badge badge-danger">no</span>
                                @endif
                            </td>
                            <td>
                                <form method="POST" action=" {{url('dashboard/admins/promote',$admin->id)}} ">
                                     @csrf
                                        @if($admin->role->name== 'admin')
                                            <button  class="btn btn-sm btn-warning " type="submit" >
                                                <i class="fas fa-level-up-alt"></i>
                                            </button>
                                        @else
                                             <button  class="btn btn-sm btn-danger " type="submit" >
                                                <i class="fas fa-level-down-alt"></i>
                                            </button>
                                        @endif


                                </form>
                            </td>

                            </tr>
                        @endforeach
                      </tbody>
                    </table>
                    <div class="d-flex my-3 justify-content-center">
                        {{$admins->links()}}
                    </div>


                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
        <!-- /table-->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>

@endsection

