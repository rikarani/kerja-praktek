@use('App\Support\Helper')
@use('Illuminate\Support\Collection')

<div class="px-4 py-6 sm:px-6 lg:px-8">
  <div class="mx-auto max-w-7xl">
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
      <div class="grid grid-cols-3 gap-2 lg:flex lg:flex-wrap">
        <button
          class="{{ blank($category) ? 'bg-brand-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-300' }} rounded-lg px-4 py-2 text-sm font-medium"
          wire:click="$set('category', '')">
          Semua
        </button>
        @foreach ($categories as $cat)
          <button
            class="{{ $category === $cat->slug ? 'bg-brand-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-300' }} rounded-lg px-4 py-2 text-sm font-medium"
            wire:click="$set('category', '{{ $cat->slug }}')">
            {{ $cat->name }}
          </button>
        @endforeach
      </div>
      <div class="relative w-full sm:max-w-xs">
        <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
          <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="m21 21-4.35-4.35M10.5 18a7.5 7.5 0 100-15 7.5 7.5 0 000 15z" />
          </svg>
        </span>
        <input
          class="focus:border-brand-500 focus:ring-brand-500 w-full rounded-lg border border-gray-300 bg-white py-2.5 pl-10 pr-4 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white"
          type="text" wire:model.live="search" placeholder="Cari kegiatan">
      </div>
    </div>
    <div>
      @if ($activities->isEmpty())
        <p class="py-20 text-center text-lg text-gray-500 dark:text-gray-400">
          Tidak ada kegiatan
        </p>
      @else
        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
          @foreach ($activities as $activity)
            @php
              $files = Storage::disk('google')->allFiles("$activity->year/$activity->title");
              $firstImage = Collection::make($files)->first();
              $thumbnail = Helper::getPhotoURL($firstImage);
            @endphp
            <article
              class="group relative overflow-hidden rounded-xl border border-gray-200 bg-white transition hover:-translate-y-0.5 hover:shadow-lg dark:border-gray-700 dark:bg-gray-800"
              wire:key="{{ $activity->slug }}">
              <a class="absolute inset-0 z-10" href="{{ route('activity.detail', $activity->slug) }}"
                aria-label="{{ $activity->title }}">
              </a>
              <div class="overflow-hidden">
                <img class="h-48 w-full object-cover transition group-hover:scale-[1.03]" src="{{ $thumbnail }}"
                  alt="{{ $activity->title }}">
              </div>
              <div class="flex flex-col p-5">
                <div class="mb-2 flex items-center justify-between text-xs text-gray-500">
                  <span
                    class="rounded-md bg-gray-100 px-2 py-1 font-medium text-gray-700 dark:bg-gray-700 dark:text-gray-200">
                    {{ Str::ucfirst($activity->category->name) }}
                  </span>
                  <span>{{ $activity->start_date->translatedFormat('d F Y') }}</span>
                </div>
                <h2 class="mb-2 line-clamp-2 text-lg font-semibold text-gray-900 dark:text-white">
                  {{ $activity->title }}
                </h2>
                <p class="mb-4 line-clamp-3 text-sm text-gray-600 dark:text-gray-400">
                  {{ $activity->excerpt }}
                </p>
                <div class="flex items-center justify-between border-t border-gray-100 pt-4 dark:border-gray-700">
                  <div class="flex items-center gap-3">
                    <img class="h-8 w-8 rounded-full object-cover"
                      src="https://flowbite.com/docs/images/people/profile-picture-2.jpg"
                      alt="{{ $activity->author->name }}">
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">
                      {{ $activity->author->name }}
                    </span>
                  </div>
                  <span class="text-brand-600 dark:text-brand-400 text-sm font-medium">
                    Detail →
                  </span>
                </div>
              </div>
            </article>
          @endforeach
        </div>
      @endif
    </div>
  </div>
</div>
