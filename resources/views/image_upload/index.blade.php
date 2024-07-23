@extends('layout.master_layout')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h3 class="m-0">Image Gallery</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active"><a href="{{ url('/upload') }}" id="back-firm"
                                    class="btn btn-primary">Upload Images</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ $message }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h4>Images from Database</h4>
                        <div class="row">
                            @foreach ($dbImagePaths as $path)
                                <div class="col-md-4 mb-4">
                                    <div class="card" style="width: 100%;">
                                        <img src="{{ asset($path) }}" class="card-img-top fixed-size-img" alt="Image">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h4>Images not in Database</h4>
                        <div class="row">
                            @foreach ($nonDbImages as $path)
                                <div class="col-md-4 mb-4">
                                    <div class="card" style="width: 100%;">
                                        <img src="{{ asset($path) }}" class="card-img-top fixed-size-img" alt="Image">
                                        <div class="card-body">
                                            <form action="{{ route('images.delete') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="path" value="{{ $path }}">
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('customStyles')
    <style>
        .card {
                height: 300px;
                overflow: hidden;
            }

            .card-img-top {
                object-fit: cover;
                height: 100%;
                width: 100%;
            }

        .fixed-size-img {
            height: 200px;
            width: 100%;
            object-fit: cover;
        }
    </style>
@endpush
