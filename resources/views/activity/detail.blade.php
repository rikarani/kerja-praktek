@php
  [$photos, $videos] = App\Support\Helper::getDocumentationLinks(Storage::disk('google')->files($activity->title));
@endphp

@extends('root')

@section('content')
  <main class="bg-white pb-16 pt-8 antialiased lg:pb-24 lg:pt-16 dark:bg-gray-900">
    <div class="mx-auto flex max-w-screen-xl justify-between px-4">
      <article
        class="format format-sm sm:format-base lg:format-lg format-blue dark:format-invert mx-auto w-full max-w-2xl">
        <header class="not-format mb-4 lg:mb-6">
          <a class="mb-4 inline-flex items-center gap-2 text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white"
            href="/">
            <svg class="size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
            <span>Kembali ke Halaman Utama</span>
          </a>
          <h1 class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl dark:text-white">
            {{ $activity->title }}
          </h1>
        </header>
        <div>
          <p class="lead">{{ $activity->excerpt }}</p>
          {!! $activity->description !!}
        </div>
        <div>
          <h2>Foto</h2>
          <p>beberapa foto yang sempat diambil selama kegiatan berlangsung</p>
          <div class="f-carousel" id="myCarousel">
            <div class="f-carousel__viewport">
              @foreach ($photos as $photo)
                <div class="f-carousel__slide" data-fancybox="gallery" data-lazy-src="{{ $photo }}"
                  data-thumb-src="{{ $photo }}">
                  <img class="aspect-video" src="{{ $photo }}" alt="{{ $activity->title }}"
                    referrerpolicy="no-referrer">
                </div>
              @endforeach
            </div>
          </div>
        </div>
        @if ($videos->isNotEmpty())
          <div>
            <h2>Video</h2>
            <p>beberapa video yang sempat diambil selama kegiatan berlangsung</p>
            @foreach ($videos as $video)
              <div class="aspect-video">
                <iframe class="h-full w-full" src="{{ $video }}"></iframe>
              </div>
            @endforeach
          </div>
        @endif
      </article>
    </div>
  </main>
  <aside class="bg-gray-50 py-8 lg:py-24 dark:bg-gray-800" aria-label="Related articles">
    <div class="mx-auto max-w-screen-xl px-4">
      <h2 class="mb-8 text-2xl font-bold text-gray-900 dark:text-white">Kegiatan Lainnya</h2>
      <div class="grid gap-12 sm:grid-cols-2 lg:grid-cols-4">
        @foreach ($others as $other)
          <article class="max-w-xs">
            <a href="#">
              <img class="mb-5 rounded-lg" src="https://picsum.photos/296/193.webp?blur=2&random={{ $loop->iteration }}"
                alt="Image 1">
            </a>
            <h2 class="mb-2 text-xl font-bold leading-tight text-gray-900 dark:text-white">
              <a href="{{ route('activity.detail', ['activity' => $other->slug]) }}">{{ $other->title }}</a>
            </h2>
            <p class="mb-4 line-clamp-3 text-gray-500 dark:text-gray-400">
              {{ $other->excerpt }}
            </p>
            <a class="text-primary-600 dark:text-primary-500 inline-flex items-center font-medium underline underline-offset-4 hover:no-underline"
              href="{{ route('activity.detail', ['activity' => $other->slug]) }}">
              Lihat Selengkapnya
            </a>
          </article>
        @endforeach
      </div>
    </div>
  </aside>
  <footer class="bg-white antialiased dark:bg-gray-800">
    <div class="mx-auto max-w-screen-xl p-4 py-6 md:p-8 lg:p-10">
      <div class="text-center">
        <p class="text-center text-sm text-gray-500 dark:text-gray-400">
          {{ now()->year }} - Teknik Informatika Universitas Tanjungpura
        </p>
        <ul class="mt-5 flex justify-center space-x-5">
          <li>
            <a class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white" href="#">
              <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 8 19">
                <path fill-rule="evenodd"
                  d="M6.135 3H8V0H6.135a4.147 4.147 0 0 0-4.142 4.142V6H0v3h2v9.938h3V9h2.021l.592-3H5V3.591A.6.6 0 0 1 5.592 3h.543Z"
                  clip-rule="evenodd" />
              </svg>
            </a>
          </li>
          <li>
            <a class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white" href="#">
              <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 20 20">
                <path fill="currentColor"
                  d="M12.186 8.672 18.743.947h-2.927l-5.005 5.9-4.44-5.9H0l7.434 9.876-6.986 8.23h2.927l5.434-6.4 4.82 6.4H20L12.186 8.672Zm-2.267 2.671L8.544 9.515 3.2 2.42h2.2l4.312 5.719 1.375 1.828 5.731 7.613h-2.2l-4.699-6.237Z" />
              </svg>
            </a>
          </li>
          <li>
            <a class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white" href="#">
              <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                  d="M10 .333A9.911 9.911 0 0 0 6.866 19.65c.5.092.678-.215.678-.477 0-.237-.01-1.017-.014-1.845-2.757.6-3.338-1.169-3.338-1.169a2.627 2.627 0 0 0-1.1-1.451c-.9-.615.07-.6.07-.6a2.084 2.084 0 0 1 1.518 1.021 2.11 2.11 0 0 0 2.884.823c.044-.503.268-.973.63-1.325-2.2-.25-4.516-1.1-4.516-4.9A3.832 3.832 0 0 1 4.7 7.068a3.56 3.56 0 0 1 .095-2.623s.832-.266 2.726 1.016a9.409 9.409 0 0 1 4.962 0c1.89-1.282 2.717-1.016 2.717-1.016.366.83.402 1.768.1 2.623a3.827 3.827 0 0 1 1.02 2.659c0 3.807-2.319 4.644-4.525 4.889a2.366 2.366 0 0 1 .673 1.834c0 1.326-.012 2.394-.012 2.72 0 .263.18.572.681.475A9.911 9.911 0 0 0 10 .333Z"
                  clip-rule="evenodd" />
              </svg>
            </a>
          </li>
          <li>
            <a class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white" href="#">
              <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                  d="M10 0a10 10 0 1 0 10 10A10.009 10.009 0 0 0 10 0Zm6.613 4.614a8.523 8.523 0 0 1 1.93 5.32 20.094 20.094 0 0 0-5.949-.274c-.059-.149-.122-.292-.184-.441a23.879 23.879 0 0 0-.566-1.239 11.41 11.41 0 0 0 4.769-3.366ZM8 1.707a8.821 8.821 0 0 1 2-.238 8.5 8.5 0 0 1 5.664 2.152 9.608 9.608 0 0 1-4.476 3.087A45.758 45.758 0 0 0 8 1.707ZM1.642 8.262a8.57 8.57 0 0 1 4.73-5.981A53.998 53.998 0 0 1 9.54 7.222a32.078 32.078 0 0 1-7.9 1.04h.002Zm2.01 7.46a8.51 8.51 0 0 1-2.2-5.707v-.262a31.64 31.64 0 0 0 8.777-1.219c.243.477.477.964.692 1.449-.114.032-.227.067-.336.1a13.569 13.569 0 0 0-6.942 5.636l.009.003ZM10 18.556a8.508 8.508 0 0 1-5.243-1.8 11.717 11.717 0 0 1 6.7-5.332.509.509 0 0 1 .055-.02 35.65 35.65 0 0 1 1.819 6.476 8.476 8.476 0 0 1-3.331.676Zm4.772-1.462A37.232 37.232 0 0 0 13.113 11a12.513 12.513 0 0 1 5.321.364 8.56 8.56 0 0 1-3.66 5.73h-.002Z"
                  clip-rule="evenodd" />
              </svg>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </footer>
@endsection
