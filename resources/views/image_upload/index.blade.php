{{-- @if ((!empty(auth()->user()) && auth()->user()->role == 1) || auth()->user()->role == 2) --}}
@extends('layout.master_layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h3 class="m-0">Upload Image</h3>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active"><a href="{{ url('/upload') }}" id="back-firm"
                                    class="btn btn-primary">Upload Images</a></li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->

        </div>
        <!-- /.content-header -->
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ $message }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <section class="content">
            <div class="container">
                <div class="row">
                    <div class="col-6">

                        <h4>Images from Database</h4>
                        <ul>
                            @foreach ($dbImagePaths as $path)
                                <li>
                                    <img src="{{ asset($path) }}" alt="Image" style="height: 90px; width:90px;">
                                    <br>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-6">
                        <h4>Images not in Database</h4>
                        <ul>
                            @foreach ($nonDbImages as $path)
                                <li><img src="{{ asset($path) }}" alt="Image" style="height: 90px; width:90px;" id="f_img{{ $path }}"></li>
                                <form action="{{ route('images.delete') }}" method="POST" style="display:inline;">
                                    @csrf
                                    <input type="hidden" name="path" value="{{ $path }}">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            @endforeach
                            <br>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('customScript')
    <script src="{{ asset('theme_assests/custom_js/addEmployee.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.delete-image').on('click', function() {
                var button = $(this);
                button.parents('li').first().remove();
                alert('Image deleted successfully.');
            });
        });
    </script>
@endpush
{{-- @else
  <script> window.location.href = "{{ url('/admin/login/index') }}"; </script>
  @endif --}}
