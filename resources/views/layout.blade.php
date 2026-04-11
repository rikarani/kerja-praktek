@extends('root')

@section('content')
  <div class="flex h-screen overflow-hidden">
    <x-sidebar />
    <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
      <x-header />
      <main>
        <div class="max-w-(--breakpoint-2xl) mx-auto p-4 md:p-6">
          @yield('main-content')
        </div>
      </main>
    </div>
  </div>
@endsection
