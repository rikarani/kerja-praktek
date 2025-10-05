@extends('root')

@section('content')
  <section class="min-h-dvh bg-white dark:bg-gray-900">
    <div class="mx-auto max-w-screen-xl px-4 py-8 lg:px-6 lg:py-16">
      <div class="mx-auto mb-8 max-w-screen-sm text-center lg:mb-16">
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
