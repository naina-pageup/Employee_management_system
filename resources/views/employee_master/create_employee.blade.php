@if ((!empty(auth()->user()) && auth()->user()->role == 1) || auth()->user()->role == 2)
    @extends('layout.master_layout')
    @section('content')
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h3 class="m-0">Add Employee</h3>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item active"><a href="{{ url('admin/employee') }}" id="back-firm"
                                        class="btn btn-primary">Back</a></li>
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
                            <form id="add-designation-form" action="{{ url('admin/employee/store') }}" method="POST">
                                @csrf
                                @method('post')
                                <div class="row">
                                    <div class="col-6 form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" placeholder="Name" name="name"
                                            autocomplete="off" pattern="[a-z A-Z]*" title="Please Enter Valid Username Name"
                                            required>
                                    </div>

                                    @if ($errors->has('name'))
                                        <p class="text-danger">{{ $errors->first('name') }}</p>
                                    @endif

                                    <div class="col-6 form-group">
                                        <label>Salary</label>
                                        <input type="text" class="form-control" placeholder="Salary" name="salary"
                                            autocomplete="off" required>
                                    </div>

                                    @if ($errors->has('salary'))
                                        <p class="text-danger">{{ $errors->first('salary') }}</p>
                                    @endif

                                    <div class="col-6 form-group">
                                        <label>Mobile</label>
                                        <input type="number" class="form-control" placeholder="Mobile" name="mobile"
                                            minlength="10" maxlength="10" autocomplete="off" required>
                                    </div>

                                    @if ($errors->has('mobile'))
                                        <p class="text-danger">{{ $errors->first('mobile') }}</p>
                                    @endif

                                    <div class="col-6 form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" placeholder="Email " name="email"
                                            autocomplete="off" required>
                                    </div>

                                    @if ($errors->has('email'))
                                        <p class="text-danger">{{ $errors->first('email') }}</p>
                                    @endif

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Select Department</label>
                                            <select class="form-control" name="Department" id="department" required>
                                                <option>Select Department</option>
                                                @foreach ($Deparments as $Dept)
                                                    <option value="{{ $Dept->id }}">{{ $Dept->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    @if ($errors->has('Department'))
                                        <p class="text-danger">{{ $errors->first('Department') }}</p>
                                    @endif

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Select Designation </label>
                                            <select class="form-control" name="designation" id="designation" required>
                                                <option>Select Designation</option>
                                            </select>
                                        </div>
                                    </div>

                                    @if ($errors->has('designation'))
                                        <p class="text-danger">{{ $errors->first('designation') }}</p>
                                    @endif

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Select Manager</label>
                                            <select class="form-control" name="manager_id">
                                                <option value="0">Select Manager</option>
                                                @foreach ($Mangers as $manger)
                                                    <option value="{{ $manger->id }}">{{ $manger->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    @if ($errors->has('manager_id'))
                                        <p class="text-danger">{{ $errors->first('manager_id') }}</p>
                                    @endif

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Joining Date:</label>
                                            <input type="date" class="form-control  unstyled" name="joining_date">
                                        </div>
                                    </div>

                                    @if ($errors->has('joining_date'))
                                        <p class="text-danger">{{ $errors->first('joining_date') }}</p>
                                    @endif

                                    <div class="col-sm-12">

                                        <div class="form-group">
                                            <label>Address</label>
                                            <textarea class="form-control" rows="3" placeholder="Enter ..." name="address" required></textarea>
                                        </div>
                                    </div>

                                    @if ($errors->has('address'))
                                        <p class="text-danger">{{ $errors->first('address') }}</p>
                                    @endif

                                </div>
                                <input type="submit" class="btn btn-outline-primary  btn-block" id="add-dept"
                                    value="Add" name="Add">
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.content -->
                </div>
            </section>
        </div>
    @endsection
    @push('customScript')
        <script src="{{ asset('theme_assests/custom_js/addEmployee.js') }}"></script>
    @endpush
@else
    <script>
        window.location.href = "{{ url('/admin/login/index') }}";
    </script>
@endif
