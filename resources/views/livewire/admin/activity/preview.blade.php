<div class="mx-auto max-w-7xl px-4 py-8 lg:px-8 lg:py-16">
  <article class="mx-auto w-full">
    <header class="mb-10 border-b border-gray-200 pb-6 dark:border-gray-700">
      <div class="flex items-center justify-between">
        <a class="mb-4 inline-flex items-center gap-2 text-sm text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white"
          href="{{ route('activity.index') }}">
          <span class="icon-[tabler--arrow-left] size-5"></span>
          <span>Kembali ke List Kegiatan</span>
        </a>
        @if ($activity->published)
          <button
            class="bg-warning-500 hover:bg-warning-600 shadow-theme-xs inline-flex max-w-max items-center justify-center gap-2 rounded-lg border border-gray-300 px-4 py-2.5 text-white dark:border-gray-700"
            wire:click="unpublish">
            <span class="icon-[tabler--x] size-4"></span>
            <span>Batalkan Publikasi</span>
          </button>
        @else
          <button
            class="bg-success-500 hover:bg-success-600 shadow-theme-xs inline-flex items-center justify-center gap-2 rounded-lg border border-gray-300 px-4 py-2.5 text-white dark:border-gray-700"
            wire:click="publish">
            <span class="icon-[tabler--check] size-5"></span>
            <span>Publikasi</span>
          </button>
        @endif
      </div>
      <h1 class="mt-4 text-3xl font-bold leading-tight text-gray-900 lg:text-4xl dark:text-white">
        {{ $activity->title }}
      </h1>
      <div class="mt-6 flex items-center gap-4">
        <img class="size-12 rounded-full object-cover"
          src="{{ $activity->author->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($activity->author->name) }}"
          alt="{{ $activity->author->name }}">
        <div>
          <p class="font-medium text-gray-900 dark:text-white">
            {{ $activity->author->name }}
          </p>
          <p class="text-sm text-gray-500 dark:text-gray-400">
            {{ $activity->created_at->translatedFormat('d F Y') }}
          </p>
        </div>
      </div>
    </header>
    <div
      class="border-brand-500 format dark:border-brand-400 mb-10 w-full min-w-full rounded-xl border-l-4 bg-gray-50 p-6 text-lg font-medium text-gray-700 dark:bg-gray-800 dark:text-gray-200">
      {{ $activity->excerpt }}
    </div>
    <div class="format max-w-none">
      {!! $activity->description !!}
    </div>
    <div class="mt-10" x-data="{ activeTab: 'photo' }">
      <div class="border-b border-gray-200 dark:border-gray-800">
        <nav
          class="[&amp;::-webkit-scrollbar-thumb]:rounded-full [&amp;::-webkit-scrollbar-thumb]:bg-gray-200 dark:[&amp;::-webkit-scrollbar-thumb]:bg-gray-600 dark:[&amp;::-webkit-scrollbar-track]:bg-transparent [&amp;::-webkit-scrollbar]:h-1.5 -mb-px flex space-x-2 overflow-x-auto">
          <button
            class="inline-flex items-center border-b-2 px-2.5 py-2 text-sm font-medium transition-colors duration-200 ease-in-out"
            :class="activeTab === 'photo' ?
                'text-brand-500 dark:text-brand-400 border-brand-500 dark:border-brand-400' :
                'bg-transparent text-gray-500 border-transparent  hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200'"
            @click="activeTab = 'photo'">
            Dokumentasi Foto
          </button>
          <button
            class="inline-flex items-center border-b-2 px-2.5 py-2 text-sm font-medium transition-colors duration-200 ease-in-out"
            :class="activeTab === 'video' ?
                'text-brand-500 dark:border-brand-400  dark:text-brand-400 border-brand-500' :
                'bg-transparent text-gray-500 border-transparent  hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200'"
            @click="activeTab = 'video'">
            Dokumentasi Video
          </button>
        </nav>
      </div>
      <div class="pt-4 dark:border-gray-800">
        <div x-show="activeTab === 'photo'">
          @if ($photos->isNotEmpty())
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
              @foreach ($photos as $photo)
                <a class="group block overflow-hidden rounded-lg" data-fancybox="gallery" href="{{ $photo }}">
                  <img class="h-48 w-full object-cover transition group-hover:scale-105" src="{{ $photo }}"
                    alt="{{ $activity->title }}" loading="lazy" referrerpolicy="no-referrer">
                </a>
              @endforeach
            </div>
          @else
            <div class="flex flex-col items-center justify-center py-24 text-center">
              <span class="icon-[tabler--alert-hexagon] size-10"></span>
              <p class="text-lg font-medium text-gray-600 dark:text-gray-300">
                Tidak ada data
              </p>
              <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Belum ada dokumentasi dalam bentuk foto
              </p>
            </div>
          @endif
        </div>
        <div style="display: none;" x-show="activeTab === 'video'">
          @if ($videos->isNotEmpty())
            <div class="grid gap-4 sm:grid-cols-3">
              @foreach ($videos as $video)
                <div class="aspect-video overflow-hidden rounded-lg">
                  <iframe class="h-full w-full" src="{{ $video }}" allowfullscreen>
                  </iframe>
                </div>
              @endforeach
            </div>
          @else
            <div class="flex flex-col items-center justify-center py-24 text-center">
              <span class="icon-[tabler--alert-hexagon] size-10"></span>
              <p class="text-lg font-medium text-gray-600 dark:text-gray-300">
                Tidak ada data
              </p>
              <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Belum ada dokumentasi dalam bentuk video
              </p>
            </div>
          @endif
        </div>
      </div>
    </div>
  </article>
</div>
