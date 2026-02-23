@extends('root')

@section('content')
  <div class="z-1 relative bg-white p-6 sm:p-0 dark:bg-gray-900">
    <div class="relative flex h-screen w-full flex-col justify-center sm:p-0 lg:flex-row dark:bg-gray-900">
      <!-- Form -->
      <div class="flex w-full flex-1 flex-col lg:w-1/2">
        <div class="mx-auto flex w-full max-w-md flex-1 flex-col justify-center">
          <div>
            <div class="mb-5 sm:mb-8">
              <h1 class="text-title-sm sm:text-title-md mb-2 font-semibold text-gray-800 dark:text-white/90">
                Login
              </h1>
              <p class="text-sm text-gray-500 dark:text-gray-400">
                pake username dan password
              </p>
            </div>
            <div>
              <livewire:auth.login />
            </div>
          </div>
        </div>
      </div>
      <div class="bg-brand-950 relative hidden h-full w-full items-center lg:grid lg:w-1/2 dark:bg-white/5">
        <div class="z-1 flex items-center justify-center">
          @include('partials.common-grid-shape')
          <div class="flex max-w-xs flex-col items-center">
            <img src="{{ asset('images/logo untan.png') }}" alt="Logo" />
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
