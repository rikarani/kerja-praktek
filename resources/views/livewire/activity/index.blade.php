<div class="mx-auto mt-10 max-w-2xl border-t border-gray-700 pt-10 lg:mx-0 lg:max-w-none">
  <input class="mb-10 w-full rounded-md bg-gray-800 p-3 text-white" type="text" wire:model.live="search"
    placeholder="Cari Kegiatan..." />
  <div class="grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 lg:mx-0 lg:max-w-none lg:grid-cols-3">
    @if ($activities->isEmpty())
      <div class="col-span-3 text-center">
        <p class="text-gray-500">Tidak ada kegiatan yang ditemukan.</p>
      </div>
    @else
      @foreach ($activities as $activity)
        <article class="flex max-w-xl flex-col items-start justify-between" wire:key="{{ $activity->slug }}">
          <div class="flex items-center gap-x-4 text-xs">
            <time class="text-gray-400"
              datetime="2020-03-16">{{ $activity->start_date->translatedFormat('d F Y') }}</time>
            <a class="relative z-10 rounded-full bg-gray-800/60 px-3 py-1.5 font-medium text-gray-300 hover:bg-gray-800"
              href="#">{{ Str::ucfirst($activity->type) }}</a>
          </div>
          <div class="group relative grow">
            <h3 class="mt-3 text-lg/6 font-semibold text-white group-hover:text-gray-300">
              <a href="{{ route('activity.detail', $activity->slug) }}">
                <span class="absolute inset-0"></span>
                {{ $activity->title }}
              </a>
            </h3>
            <p class="mt-5 line-clamp-3 text-sm/6 text-gray-400">
              {{ $activity->description }}
            </p>
          </div>
          <div class="relative mt-8 flex items-center gap-x-4 justify-self-end">
            <img class="size-10 rounded-full bg-gray-800"
              src="https://images.unsplash.com/photo-1519244703995-f4e0f30006d5?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
              alt="" />
            <div class="text-sm/6">
              <p class="font-semibold text-white">
                <a href="#">
                  <span class="absolute inset-0"></span>
                  Michael Foster
                </a>
              </p>
              <p class="text-gray-400">Co-Founder / CTO</p>
            </div>
          </div>
        </article>
      @endforeach
    @endif
  </div>
</div>
