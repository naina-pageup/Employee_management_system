<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login Page</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset(' theme_assests/plugins/fontawesome-free/css/all.min.css ')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('theme_assests/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('theme_assests/dist/css/adminlte.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition register-page">
    <div class="login-box">
        <div class="login-logo">
          <a href="../../index2.html"><b>Admin</b>LTE</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
          <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in to start your session</p>
            @if(Session::has('status'))
            <p class="text-success fs-6 fw-bold">{{ Session::get('status') }} </p>
            @endif
            <form action="{{ url('/admin/login') }}" method="post">
                @csrf
                @method('post')
              <div class="input-group mb-3">
                <input type="email" class="form-control" placeholder="Email" name="email" required>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                  </div>
                </div>
              </div>
              @if($errors->has('email'))
                <p class="text-danger">{{ $errors->first('email') }}</p>
                @endif
              <div class="input-group mb-3">
                <input type="password" class="form-control" placeholder="Password" name="password" minlength="8" required>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
              @if($errors->has('password'))
              <p class="text-danger">{{ $errors->first('password') }}</p>
              @endif
              <div class="row">
               
                <!-- /.col -->
                @if(session()->has('error'))
                <div class="col-12 ">
               
                <p class="text-danger fs-6 fw-bold" >{{ Session::get('error') }}</p>
               
              </div>
                @endif
                <div class="col-12">
                  <button type="submit" class="btn btn-primary btn-block" name="login">Sign In</button>
                </div>
                <!-- /.col -->
              </div>
            </form>
      
           
      
            {{-- <p class="mb-1">
              <a href="forgot-password.html">I forgot my password</a>
            </p> --}}
            <p class="mb-0">
              <a href="{{ url('/admin/registration') }}" class="text-center">Register a new membership</a>
            </p>
          </div>
          <!-- /.login-card-body -->
        </div>
      </div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="{{ asset('theme_assests/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('theme_assests/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('theme_assests/dist/js/adminlte.min.js') }}"></script>
</body>
</html>
