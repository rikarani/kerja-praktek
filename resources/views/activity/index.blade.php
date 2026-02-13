@extends('root')

@section('content')
  <section
    class="from-brand-50 to-brand-100 bg-linear-to-br relative min-h-dvh via-white dark:from-gray-900 dark:via-gray-900 dark:to-gray-800">
    <div class="mx-auto max-w-7xl px-4 py-6 lg:px-6">
      <div class="flex justify-end">
        @auth
          <a class="bg-brand-500 hover:bg-brand-600 inline-flex items-center gap-2 rounded-xl px-5 py-3 text-sm font-semibold text-white shadow-lg transition hover:shadow-xl"
            href="{{ route('dashboard') }}">
            Dashboard
            <span class="icon-[tabler--layout] size-5"></span>
          </a>
        @else
          <a class="bg-brand-500 hover:bg-brand-600 inline-flex items-center gap-2 rounded-xl px-5 py-3 text-sm font-semibold text-white shadow-lg transition hover:shadow-xl"
            href="{{ route('login') }}">
            Login
            <span class="icon-[tabler--login-2] size-5"></span>
          </a>
        @endauth
      </div>
    </div>
    <div class="py-4` mx-auto flex max-w-7xl flex-col items-center justify-center px-4 text-center lg:px-6">
      <h1 class="mb-4 text-4xl font-extrabold tracking-tight text-gray-900 lg:text-5xl dark:text-white">
        Dokumentasi Kegiatan
      </h1>
      <p class="max-w-xl text-lg font-semibold text-gray-600 dark:text-gray-400">
        Teknik Informatika Universitas Tanjungpura
      </p>
    </div>
    <livewire:activity.index />
  </section>
@endsection

@section('footer')
  <x-partial.footer />
@endsection
