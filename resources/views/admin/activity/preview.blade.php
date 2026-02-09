@extends('root')

@section('content')
  <main class="bg-white dark:bg-gray-900">
    <livewire:admin.activity.preview :$activity />
    <x-partial.footer />
  </main>
@endsection
