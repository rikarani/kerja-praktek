@use('App\Support\Helper')

@php
  $folderFullPath = Request::query('path');
@endphp

<div>
  @if (count($explorer['folders']))
    <h2 class="mb-3 text-lg font-semibold text-gray-900">Daftar Folder</h2>
    <div class="mb-10 grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-4">
      @foreach ($explorer['folders'] as $folder)
        <div
          class="group relative flex items-center justify-between rounded-lg border bg-white px-4 py-3 transition hover:bg-gray-50">
          <a class="flex max-w-max items-center gap-3"
            href="?path={{ urlencode($explorer['path'] ? $explorer['path'] . '/' . $folder : $folder) }}">
            <span class="icon-[tabler--folder] size-6"></span>
            <span class="truncate text-sm font-medium text-gray-800">
              {{ $folder }}
            </span>
          </a>
          <div class="relative" x-data="{ open: false }">
            <button class="rounded p-1 text-gray-500 hover:bg-gray-200" @click.stop="open = !open">
              <span class="icon-[tabler--dots-vertical] size-5"></span>
            </button>
            <div class="absolute right-0 z-30 mt-2 w-40 rounded-md border bg-white py-1 text-sm shadow" x-show="open"
              @click.outside="open = false" x-transition>
              <button class="block w-full px-3 py-2 text-left hover:bg-gray-100"
                @click="$dispatch('rename-folder', { name: '{{ $folder }}' })">
                Rename
              </button>
              <form method="POST"
                action="{{ url("/kegiatan/$activity->slug/folder/$folder/delete?path=$folderFullPath") }}">
                @csrf
                @method('DELETE')
                <button class="block w-full px-3 py-2 text-left text-red-600 hover:bg-red-50" type="submit">
                  Hapus
                </button>
              </form>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  @endif

  <h2 class="mb-3 text-lg font-semibold text-gray-900">Daftar File</h2>
  @if (count($explorer['files']) === 0)
    <p class="italic text-gray-500">Tidak ada file di folder ini.</p>
  @else
    <div class="grid grid-cols-2 gap-4 sm:grid-cols-4" x-data="{ open: null }">
      @foreach ($explorer['files'] as $file)
        @php
          $id = Helper::extractID($file['url']);
          $isPhoto = $file['type'] === 'photo';
          $thumb = $isPhoto ? $file['url'] : "https://drive.google.com/thumbnail?id=$id";
        @endphp
        <div class="relative flex flex-col rounded-xl border bg-white shadow-sm transition hover:shadow-md">
          <div class="flex items-center justify-between px-3 pt-3">
            <div class="flex items-center gap-3">
              @if ($isPhoto)
                <span class="icon-[tabler--photo] size-6"></span>
              @else
                <span class="icon-[tabler--video] size-6"></span>
              @endif
              <div class="line-clamp-2 text-sm font-medium leading-tight text-gray-800">
                <span>{{ $file['name'] }}</span>
              </div>
            </div>
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
                <div>
                  <form method="post"
                    action="{{ route('admin.activity.file.delete', ['activity' => $activity, 'path' => $file['name']]) }}">
                    @csrf
                    @method('DELETE')
                    <button class="block w-full px-3 py-2 text-left text-red-600 hover:bg-red-50" type="submit">
                      Hapus
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <a class="mt-3 block aspect-square w-full overflow-hidden rounded-b-xl bg-gray-100"
            href="{{ $file['url'] }}" target="_blank">
            <img class="h-full w-full object-cover" src="{{ $thumb }}" alt="{{ $file['name'] }}"
              onerror="this.src='https://via.placeholder.com/300?text=No+Preview'" />
          </a>
        </div>
      @endforeach
    </div>
  @endif
  <button
    class="fixed bottom-20 right-5 flex items-center gap-2 rounded-full bg-red-500 px-5 py-3 text-2xl/none text-white"
    @click="$dispatch('add-folder')">
    <span class="icon-[tabler--folder] size-4.5"></span>
    <span class="text-base">Folder Baru</span>
  </button>
  <button
    class="fixed bottom-5 right-5 flex items-center gap-2 rounded-full bg-red-500 px-5 py-3 text-2xl/none text-white"
    @click="$dispatch('add-documentations')">
    <span class="icon-[tabler--plus] size-4.5"></span>
    <span class="text-base">Tambah File</span>
  </button>
  <livewire:modal.admin.activity.add-documentations :$activity />
  <livewire:modal.admin.activity.add-folder :$activity />
</div>
