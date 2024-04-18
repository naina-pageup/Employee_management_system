@if(!empty(auth()->user()) && auth()->user()->role == 1 || auth()->user()->role == 2)
@extends('layout.master_layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3 class="m-0">Add Department</h3>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"><a href="{{ url('admin/department') }}" id="back-firm" class="btn btn-primary">Back</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->

    </div>
    <!-- /.content-header -->
    <section class="content">
      <div class="container-fluid">
      <div class="card card-primary">
      <div class="card-body">
      <div id="loader-add-customer" style="display:none;" class="overlay">
              <i class="fa fa-refresh fa-spin"></i>
              </div>
                <form id="add-designation-form" action="{{ url('admin/department/store') }}" method="POST">
                    @csrf
                    @method('post')
                <div class="row">
                  <div class="col-12 form-group">
                  <label>Department</label>
                    <input type="text" class="form-control" placeholder="Name" name="name" autocomplete="off" id="Cust-name" pattern="[a-z A-Z]*" title="Please Enter Valid Username Name" minlength="1" required>
                  </div>
                  <div class="col-12 form-group">
                  @if($errors->has('name'))
                    <p class="text-danger">{{ $errors->first('name') }}</p>
                  @endif
                  </div>
                </div>
                <input type="submit"  class="btn btn-outline-primary  btn-block" id="add-dept" value="Add" name="AddDept"> 
              </form>
              </div>
               <!-- /.card-body -->
              </div>
   <!-- /.content -->
      </div>
      </section>
      </div>
  @endsection 
  @else
  <script> window.location.href = "{{ url('/admin/login/index') }}"; </script>
  @endif