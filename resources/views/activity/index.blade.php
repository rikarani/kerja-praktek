@extends('root')

@section('content')
  <div class="min-h-dvh bg-gray-900 py-24 sm:py-32">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
      <div class="mx-auto max-w-2xl lg:mx-0">
        <h2 class="text-pretty text-4xl font-semibold tracking-tight text-white sm:text-5xl">Dokumentasi Kegiatan</h2>
        <p class="mt-2 text-lg/8 text-gray-300">Teknik Informatika UNTAN</p>
      </div>
      <livewire:activity.index />
    </div>
  </div>
@endsection
