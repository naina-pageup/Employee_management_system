@if ((!empty(auth()->user()) && auth()->user()->role == 1) || auth()->user()->role == 2)
    @extends('layout.master_layout')
    @section('content')
        @livewireStyles
        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid ">
                    <div class="p-2">
                        <livewire:employee-data-table />
                    </div>
                </div>
            </section>
        </div>
    @endsection
    @livewireScripts
    @push('customScript')
        {{-- <script src="{{ asset('theme_assests/custom_js/deleteDepartment.js') }}"></script>  --}}
        <script src="https://cdn.tailwindcss.com"></script>
    @endpush
@else
    <script>
        window.location.href = "{{ url('/admin/login/index') }}";
    </script>
@endif
