@if(!empty(auth()->user()) && auth()->user()->role == 1 || auth()->user()->role == 2)
@extends('layout.master_layout')
@section('content')
@livewireStyles
<div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Employee</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"><a href="{{ url('admin/employee/create') }}" id="add-new-user" class="btn btn-primary">Add</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
      <div class="container-fluid">
        <div class="card">
          @if(Session::has('error'))
          <p class="text-danger fs-6 fw-bold">{{ Session::get('error') }} </p>
          @endif
         @livewire('live-search-employee')
       </div>
    </section>
 </div>
  @endsection 
@livewireScripts

  @else
  <script> window.location.href = "{{ url('/admin/login/index') }}"; </script>
  @endif