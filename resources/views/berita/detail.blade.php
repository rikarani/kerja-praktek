@extends('root')

@section('content')
  <main class="bg-white dark:bg-gray-900">
    <livewire:berita.detail :$activity />
    <x-footer />
  </main>
@endsection
