@extends('root')

@section('content')
  <section
    class="from-brand-50 to-brand-100 bg-linear-to-br relative min-h-dvh via-white dark:from-gray-900 dark:via-gray-900 dark:to-gray-800">
    <div class="mx-auto max-w-7xl px-4 py-6 lg:px-6">
      <div class="flex justify-end">
        <a class="bg-brand-500 hover:bg-brand-600 inline-flex items-center gap-2 rounded-xl px-5 py-3 text-sm font-semibold text-white shadow-lg transition hover:shadow-xl"
          href="{{ route('login') }}">
          Login
          <span class="icon-[tabler--login-2] size-5"></span>
        </a>
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
    <footer class="border-t border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-900">
      <div class="mx-auto max-w-7xl px-4 py-8 lg:px-8">
        <div class="flex flex-col items-center justify-between gap-4 sm:flex-row">
          <p class="text-sm text-gray-500 dark:text-gray-400">
            © {{ now()->year }} Teknik Informatika Universitas Tanjungpura
          </p>
          <div class="flex items-center gap-6 text-sm">
            <a class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white" href="/">
              Beranda
            </a>
          </div>
        </div>
      </div>
    </footer>
  </section>
@endsection
