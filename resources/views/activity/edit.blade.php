@extends('layout')

@section('main-content')
  <div
    class="rounded-2xl border border-gray-200 bg-white px-4 pb-3 pt-4 sm:px-6 dark:border-gray-800 dark:bg-white/[0.03]">
    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
      Edit Kegiatan {{ $activity->title }}
    </h3>
    <livewire:activity.edit :$activity />
  </div>
@endsection
