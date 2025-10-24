@use('App\Support\Helper')

@php
  [$photos, $videos] = Helper::getDocumentationLinks($activity);
@endphp

<main class="min-h-dvh bg-white pb-16 pt-8 antialiased lg:pb-24 lg:pt-16 dark:bg-gray-900">
  <div class="mx-auto mb-8 flex max-w-screen-xl justify-between px-4">
    <div class="mx-auto flex w-full max-w-2xl items-center justify-between">
      <a class="inline-flex items-center gap-2 text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white"
        href="{{ route('activity.index') }}">
        <svg class="size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
          stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
        </svg>
        <span>Kembali ke List Kegiatan</span>
      </a>
      <div>
        @if ($activity->published)
          <button
            class="bg-warning-500 hover:bg-warning-600 shadow-theme-xs inline-flex flex-1 items-center justify-center gap-2 rounded-lg border border-gray-300 px-4 py-2.5 text-white dark:border-gray-700"
            wire:click="unpublish">
            <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
            <span>Batalkan Publikasi</span>
          </button>
        @else
          <button
            class="bg-success-500 hover:bg-success-600 shadow-theme-xs inline-flex flex-1 items-center justify-center gap-2 rounded-lg border border-gray-300 px-4 py-2.5 text-white dark:border-gray-700"
            wire:click="publish">
            <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
            </svg>
            <span>Publikasi</span>
          </button>
        @endif
      </div>
    </div>
  </div>
  <div class="mx-auto flex max-w-screen-xl justify-between px-4">
    <article
      class="format format-sm sm:format-base lg:format-lg format-blue dark:format-invert mx-auto w-full max-w-2xl">
      <header class="not-format mb-4 lg:mb-6">
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
