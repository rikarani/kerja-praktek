@extends('root')

@section('content')
    <div class="flex h-screen overflow-hidden">
        @include('sidebar')
        <div class="relative flex flex-col flex-1 overflow-x-hidden overflow-y-auto">
            @include('partials.header')
            <main>
                <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
                    @yield('main-content')
                </div>
            </main>
        </div>
    </div>
@endsection
