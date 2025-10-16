@extends('admin.layout')

@section('main-content')
  <div class="grid grid-cols-12 gap-4 md:gap-6">
    <div class="col-span-12 space-y-6 xl:col-span-7">
      <livewire:admin.dashboard.chart />
    </div>
  </div>
@endsection
