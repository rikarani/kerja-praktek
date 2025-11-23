@use('App\Support\Helper')

@php
  $explorer = Helper::getExplorer($activity);

  function extractId(string $url)
  {
      preg_match('/\/d\/([^\/]+)/', $url, $m);

      return $m[1] ?? null;
  }
@endphp

<div>
  {{-- ========================= --}}
  {{--        FOLDER LIST        --}}
  {{-- ========================= --}}
  @if (count($explorer['folders']))
    <h2 class="mb-3 text-lg font-semibold text-gray-900">Folders</h2>
    <div class="mb-10 grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6">
      @foreach ($explorer['folders'] as $folder)
        <a class="group flex cursor-pointer flex-col items-center rounded-xl border bg-white p-3 text-center shadow-sm transition hover:shadow-md"
          href="?path={{ urlencode($explorer['path'] ? $explorer['path'] . '/' . $folder : $folder) }}">
          <div class="flex aspect-square w-full items-center justify-center rounded-lg bg-yellow-50">
            <svg class="h-14 w-14 text-yellow-500 transition group-hover:text-yellow-600" fill="currentColor"
              viewBox="0 0 20 20">
              <path d="M2 6a2 2 0 012-2h4l2 2h6a2 2 0 012 2v7a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" />
            </svg>
          </div>
          <div class="mt-2 line-clamp-1 text-sm font-medium text-gray-700 group-hover:text-gray-900">
            {{ $folder }}
          </div>
        </a>
      @endforeach
    </div>
  @endif

  {{-- FILE LIST --}}
  <h2 class="mb-3 text-lg font-semibold text-gray-900">Daftar File</h2>
  @if (count($explorer['files']) === 0)
    <p class="italic text-gray-500">Tidak ada file di folder ini.</p>
  @else
    <div class="grid grid-cols-2 gap-4 sm:grid-cols-4" x-data="{ open: null }">
      @foreach ($explorer['files'] as $file)
        @php
          $id = extractId($file['url']);
          $thumb = $file['type'] === 'photo' ? $file['url'] : "https://drive.google.com/thumbnail?id={$id}";
        @endphp

        <div class="relative flex flex-col rounded-xl border bg-white shadow-sm transition hover:shadow-md">

          {{-- Header: filename + dropdown --}}
          <div class="flex items-center justify-between px-3 pt-3">
            {{-- Filename --}}
            <div class="line-clamp-2 text-sm font-medium leading-tight text-gray-800">
              {{ $file['name'] }}
            </div>

            {{-- Dropdown trigger --}}
            <div class="relative ml-2">
              <button class="rounded-md p-1 transition hover:bg-gray-200"
                @click.stop="open = (open === '{{ $file['name'] }}' ? null : '{{ $file['name'] }}')">
                ⋮
              </button>
              <div class="absolute right-0 z-20 mt-1 w-40 rounded-lg border bg-white py-1 text-sm shadow-lg"
                style="display: none;" x-show="open === '{{ $file['name'] }}'" x-transition
                @click.outside="open = null">
                <a class="block px-3 py-2 hover:bg-gray-100" href="{{ $file['url'] }}" target="_blank">
                  Preview
                </a>
                <a class="block px-3 py-2 hover:bg-gray-100"
                  href="{{ route('admin.activity.file.download', ['activity' => $activity, 'path' => $file['name']]) }}">
                  Download
                </a>
                <a class="block w-full px-3 py-2 text-left text-red-600 hover:bg-red-50"
                  href="{{ route('admin.activity.file.delete', ['activity' => $activity, 'path' => $file['name']]) }}">
                  Delete
                </a>
              </div>
            </div>
          </div>
          {{-- Thumbnail --}}
          <a class="mt-3 block aspect-square w-full overflow-hidden rounded-b-xl bg-gray-100" href="{{ $file['url'] }}"
            target="_blank">
            <img class="h-full w-full object-cover" src="{{ $thumb }}" alt="{{ $file['name'] }}"
              onerror="this.src='https://via.placeholder.com/300?text=No+Preview'" />
          </a>
        </div>
      @endforeach
    </div>
  @endif
  <button class="fixed bottom-5 right-5 rounded-full bg-red-500 px-5 py-3 text-3xl/none text-white"
    @click="$dispatch('add-documentations')">+</button>
  <livewire:modal.admin.activity.add-documentations :$activity />
</div>
