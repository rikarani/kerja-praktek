@extends('root')

@section('content')
  <section class="bg-linear-to-br from-brand-50 to-brand-100 relative min-h-dvh via-white">
    <nav class="border-b border-white/30 bg-white/70 backdrop-blur-md">
      <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 lg:px-6">
        <img class="size-16" src="{{ asset('images/logo untan.png') }}" alt="Logo UNTAN">
        @auth
          <a class="bg-brand-500 hover:bg-brand-600 inline-flex items-center gap-2 rounded-lg px-4 py-2 text-sm font-medium text-white transition"
            href="{{ route('dashboard') }}">
            Dashboard
            <span class="icon-[tabler--layout] size-4"></span>
          </a>
        @else
          <a class="bg-brand-500 hover:bg-brand-600 inline-flex items-center gap-2 rounded-lg px-4 py-2 text-sm font-medium text-white transition"
            href="{{ route('login') }}">
            Login
            <span class="icon-[tabler--login-2] size-4"></span>
          </a>
        @endauth
      </div>
    </nav>
    <div class="mx-auto flex max-w-7xl flex-col items-center justify-center px-4 py-10 text-center lg:px-6">
      <h1 class="mb-4 text-4xl font-extrabold tracking-tight text-gray-900 lg:text-5xl dark:text-white">
        Dokumentasi Kegiatan
      </h1>
      <p class="max-w-xl text-lg font-semibold text-gray-600 dark:text-gray-400">
        Teknik Informatika Universitas Tanjungpura
      </p>
    </div>
    <div class="mx-auto max-w-7xl px-4 pb-16 lg:px-6">
      <livewire:activity.index />
    </div>
  </section>
@endsection

@section('footer')
  <x-partial.footer />
@endsection
