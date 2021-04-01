@extends('admin.layout')
@section('main')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Categoties</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Categoties</li>
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
                    <h3 class="card-title">Categories</h3>

                     <div class="card-tools">
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#add-modal">
                            Add new
                        </button>

                    </div>

                  </div>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Name (en)</th>
                          <th>Name (ar)</th>
                          <th>Active</th>
                          <th>Actions</th>


                        </tr>
                      </thead>
                      <tbody>
                          @foreach($cats as $cat)
                            <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$cat->name('en')}}</td>
                            <td>{{$cat->name('ar')}}</td>
                            <td>
                                @if($cat->active)
                                <span class="badge badge-success">yes</span>
                                @else
                                <span class="badge badge-danger">no</span>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-sm btn-info edit-btn" type="button" data-toggle="modal" data-id="{{$cat->id}}" data-name-en="{{$cat->name('en')}}" data-name-ar=" {{$cat->name('ar')}} " data-target="#edit-modal">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <a href=" {{url("dashboard/cat/delete/$cat->id")}} " class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </a>
                                <a href=" {{url("dashboard/cat/toggle/$cat->id")}} " class="btn btn-sm btn-secondary">
                                    <i class="fas fa-toggle-on"></i>
                                </a>
                            </td>

                            </tr>
                        @endforeach
                      </tbody>
                    </table>
                    <div class="d-flex my-3 justify-content-center">
                        {{$cats->links()}}
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
  <!-- /.content-wrapper -->
<!-- /add modal -->
<div class="modal fade" id="add-modal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Add new</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            @include('admin.inc.errors')
            <form id="add-new-form" method="POST" action="{{url('dashboard/cat/store')}}">
                @csrf
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label >Name(en)</label>
                        <input type="text" class="form-control" name="name_en"  >
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label >Name(ar)</label>
                        <input type="text" class="form-control" name="name_ar" >
                    </div>
                </div>
            </div>
                <!-- /.card-body -->
                </form>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" form="add-new-form">Submit</button>
        </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- /edit modal-->
 <div class="modal fade" id="edit-modal" style="display: none;" aria-hidden="true">

    <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Edit</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        </div>
        <div class="modal-body">
            @include('admin.inc.errors')
            <form id="edit-form" method="POST" action="{{url('dashboard/cat/update')}}">
                @csrf
                <input type="hidden" name="id" id="edit-form-id">
                <div class="row">
                        <div class="col-6">
                                <div class="form-group">
                                    <label >Name(en)</label>
                                    <input type="text" class="form-control" name="name_en" id="edit-form-name-en" >
                                </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label >Name(ar)</label>
                                <input type="text" class="form-control" name="name_ar" id="edit-form-name-ar" >
                            </div>
                        </div>
                </div>
                    <!-- /.card-body -->
            </form>
        </div>
        <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" form="edit-form">Update</button>
        </div>
    </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endsection
@section('custom-js')
    <script>
        $('.edit-btn').click(function(){
            let id= $(this).attr('data-id')
            let nameEn= $(this).attr('data-name-en')
            let nameAr= $(this).attr('data-name-ar')

            $('#edit-form-id').val(id)
            $('#edit-form-name-en').val(nameEn)
            $('#edit-form-name-ar').val(nameAr)
        })
    </script>
@endsection
