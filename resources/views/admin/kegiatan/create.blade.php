@extends('admin.layout')

@section('main-content')
  <div class="rounded-2xl border border-gray-200 bg-white px-4 pb-3 pt-4 sm:px-6 dark:border-gray-800 dark:bg-white/[0.03]">
    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
      Daftar Kegiatan
    </h3>
    <livewire:admin.kegiatan.create />
  </div>
@endsection
