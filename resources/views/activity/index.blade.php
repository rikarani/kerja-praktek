@extends('root')

@section('content')
  <section class="min-h-dvh bg-white dark:bg-gray-900">
    <div class="mx-auto max-w-screen-xl px-4 py-8 lg:px-6 lg:py-8">
      <div class="justify-end-safe flex">
        <a class="bg-brand-500 shadow-theme-xs hover:bg-brand-600 inline-flex items-center gap-2 rounded-lg px-4 py-3 text-sm font-medium text-white transition"
          href="{{ route('login') }}">
          Login
        </a>
      </div>
      <div class="mx-auto mb-8 mt-4 max-w-screen-sm text-center lg:mb-16">
        <h2 class="mb-4 text-3xl font-extrabold tracking-tight text-gray-900 lg:text-4xl dark:text-white">
          Dokumentasi Kegiatan
        </h2>
        <p class="font-light text-gray-500 sm:text-xl dark:text-gray-400">
          Teknik Informatika Universitas Tanjungpura
        </p>
      </div>
      <livewire:activity.index />
    </div>
  </section>
@endsection
