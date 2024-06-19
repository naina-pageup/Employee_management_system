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
                            <li class="breadcrumb-item active"><a href="{{ url('/images') }}" id="back-firm"
                                    class="btn btn-primary">Back</a></li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->

        </div>
        <!-- /.content-header -->
        <section class="content">

            <body>
                <div class="container mt-5">
                    <h2>Upload Multiple Images</h2>
                    <button type="button" id="add-more-images" class="btn btn-secondary">Add More Images</button><br></br>
                    <form action="{{ route('images.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div id="image-upload-section">
                            <div class="container">
                                <div class="row">
                                    <div class="form-group col-6">
                                        <input type="file" name="images[]" class="form-control image-input">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="preview" class="d-flex flex-wrap"></div>
                        <button type="submit" class="btn btn-primary mt-3">Upload</button>
                    </form>
                </div>





        </section>
    </div>
@endsection
@push('customScript')
    <script src="{{ asset('theme_assests/custom_js/addEmployee.js') }}"></script>
    <script>
        $(document).ready(function() {
            function handleImageInputChange() {
                $('.image-input').off('change').on('change', function() {
                    var input = $(this);
                    var files = input[0].files;
                    var preview = $('#preview');
                    preview.empty();
                    $.each(files, function(index, file) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            var img = $(
                                '<div class="thumb"><img style ="height:90px;width:90px;" src="' +
                                e.target.result +
                                '"/><button class="remove-image">&times;</button></div>');
                            preview.append(img);
                            img.find('.remove-image').on('click', function() {
                                img.remove();
                                input.val('');
                            });
                        }
                        reader.readAsDataURL(file);
                    });
                });
            }


            handleImageInputChange();


            $('#add-more-images').on('click', function() {
                var newInput = $(
                    ' <div class="container"><div class="row"><div class="form-group col-6"><input type="file" name="images[]" class="form-control image-input"><button type="button" class="btn btn-danger remove-image-input mt-2 float-right">Remove</button></div></div></div>'
                    );
                $('#image-upload-section').append(newInput);
                handleImageInputChange();
            });

           
            $('#image-upload-section').on('click', '.remove-image-input', function() {
                $(this).parent().remove();
            });
        });
    </script>
@endpush
{{-- @else
  <script> window.location.href = "{{ url('/admin/login/index') }}"; </script>
  @endif --}}
