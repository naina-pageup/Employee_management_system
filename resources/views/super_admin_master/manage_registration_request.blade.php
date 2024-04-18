@if(!empty(auth()->user()) && auth()->user()->role == 2)
@extends('layout.master_layout')
@section('content')
<div class="content-wrapper">
     
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Registration Request</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->

    </div>
    <!-- /.content-header -->
    <section class="content">
     <div class="container-fluid">
      <div class="card">
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>S.No.</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Approved</th>
                      <th>Deny</th>

                    </tr>
                  </thead>
                  
                  <tbody id="load-table">
                    <tr>
                    @php
                        $count = 1;
                    @endphp  
                    @foreach ($registration_request as $req)
                    <td>
                        @php 
                        echo  $count++;
                        @endphp  
                    </td>
                    <td>{{ $req->name }}</td>
                    <td>{{ $req->email }}</td>
                   
                    <td><a href="{{ url('/admin/request/action',['id' => encrypt($req->id),'status' => 'Approved'])}}" class="editdept"><i class='fas fa-check'></i></a>
                    </form>
                    </td>
                    <td>
                        <form action="{{url('/admin/request/action',['id' => encrypt($req->id),'status' => 'Rejected']) }}" method="get"  id="myForm{{ $req->id }}" class="removedept">
                            @csrf
                            @method('get')
                       <button type="submit"  onclick="conformation(event,{{ $req->id }})" id="remove_dept"> <a href="#"><i class='fas fa-trash-alt'></i></a></button>
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
<script src="{{ asset('theme_assests/custom_js/denyRegistrationRequest.js') }}"></script> 
@endpush
  @else
  <script> window.location.href = "{{ url('/admin/login/index') }}"; </script>
  @endif