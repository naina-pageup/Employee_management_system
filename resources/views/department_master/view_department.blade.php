@if(!empty(auth()->user()) && auth()->user()->role == 1 || auth()->user()->role == 2)
@extends('layout.master_layout')
@section('content')
<div class="content-wrapper">
     
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Department</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"><a href="{{ url('admin/department/create') }}" id="add-new-user" class="btn btn-primary">Add</a></li>
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
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>S.No.</th>
                      <th>Department</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  
                  <tbody id="load-table">
                    <tr>
                    @php
                        $count = 1;
                    @endphp  
                    @foreach ($deparments as $dept)
                    <td>
                        @php 
                        echo  $count++;
                        @endphp  
                    </td>
                    <td>{{ $dept->name }}</td>
                    <td><a href="{{ url('/admin/department/edit',['id' => encrypt($dept->id)])}}" class="editdept"><i class='fas fa-edit'></i></a>
                        <form action="{{url('/admin/department/destroy',$dept->id) }}" method="post"  id="myForm{{ $dept->id }}" class="float-right removedept">
                            @csrf
                            @method('post')
                       <button type="submit"  onclick="conformation(event,{{ $dept->id }})" id="remove_dept"> <a href="#"><i class='fa fa-trash' aria-hidden='true'></i></a></button>
                    </form>
                    </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
   <!-- /.content -->
      </div>
   </section>
  </div>
  @endsection 
  @push('customScript')
<script src="{{ asset('theme_assests/custom_js/deleteDepartment.js') }}"></script> 
@endpush
  @else
  <script> window.location.href = "{{ url('/admin/login/index') }}"; </script>
  @endif