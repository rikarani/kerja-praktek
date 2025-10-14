<div>
  <div class="relative mb-4 lg:mb-8">
    <div class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3.5">
      <svg class="size-4 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round"
          d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
      </svg>
    </div>
    <input
      class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 ps-10 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
      type="text" wire:model.live="search" placeholder="Cari Kegiatan...">
  </div>
  @if ($activities->isEmpty())
    <p class="text-center text-2xl font-semibold">Tidak Ada Kegiatan</p>
  @else
    <div class="grid gap-8 lg:grid-cols-2">
      @foreach ($activities as $activity)
        <article class="rounded-lg border border-gray-200 bg-white p-6 shadow-md dark:border-gray-700 dark:bg-gray-800"
          wire:key="{{ $activity->slug }}">
          <div class="mb-5 flex items-center justify-between text-gray-500">
            <span
              class="bg-primary-100 text-primary-800 dark:bg-primary-200 dark:text-primary-800 inline-flex items-center rounded px-2.5 py-0.5 text-xs font-medium">
              <svg class="mr-1 h-3 w-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z">
                </path>
              </svg>
              {{ Str::ucfirst($activity->type) }}
            </span>
            <span class="text-sm">{{ $activity->start_date->diffForHumans() }}</span>
          </div>
          <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
            <a href="{{ route('activity.detail', ['activity' => $activity->slug]) }}">
              {{ $activity->title }}
            </a>
          </h2>
          <p class="mb-5 line-clamp-3 font-light text-gray-500 dark:text-gray-400">
            {{ $activity->excerpt }}
          </p>
          <div class="flex items-center justify-end">
            <a class="text-primary-600 dark:text-primary-500 inline-flex items-center font-medium hover:underline"
              href="{{ route('activity.detail', ['activity' => $activity->slug]) }}">
              Lihat Selengkapnya
              <svg class="ml-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                  d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                  clip-rule="evenodd">
                </path>
              </svg>
            </a>
          </div>
        </article>
      @endforeach
    </div>
  @endif
</div>
