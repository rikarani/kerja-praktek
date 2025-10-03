<div
  class="overflow-hidden rounded-2xl border border-gray-200 bg-white px-4 pb-3 pt-4 sm:px-6 dark:border-gray-800 dark:bg-white/[0.03]">
  <div class="mb-4 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
    <div>
      <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
        Daftar Kegiatan
      </h3>
    </div>
    <div class="flex items-center gap-3">
      <div class="relative flex-1 sm:flex-auto">
        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400">
          <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd"
              d="M3.04199 9.37363C3.04199 5.87693 5.87735 3.04199 9.37533 3.04199C12.8733 3.04199 15.7087 5.87693 15.7087 9.37363C15.7087 12.8703 12.8733 15.7053 9.37533 15.7053C5.87735 15.7053 3.04199 12.8703 3.04199 9.37363ZM9.37533 1.54199C5.04926 1.54199 1.54199 5.04817 1.54199 9.37363C1.54199 13.6991 5.04926 17.2053 9.37533 17.2053C11.2676 17.2053 13.0032 16.5344 14.3572 15.4176L17.1773 18.238C17.4702 18.5309 17.945 18.5309 18.2379 18.238C18.5308 17.9451 18.5309 17.4703 18.238 17.1773L15.4182 14.3573C16.5367 13.0033 17.2087 11.2669 17.2087 9.37363C17.2087 5.04817 13.7014 1.54199 9.37533 1.54199Z"
              fill=""></path>
          </svg>
        </span>
        <input
          class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 focus:ring-3 focus:outline-hidden h-11 w-full rounded-lg border border-gray-300 bg-transparent py-2.5 pl-11 pr-4 text-sm text-gray-800 placeholder:text-gray-400 sm:w-[300px] sm:min-w-[300px] dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
          type="text" placeholder="Search...">
      </div>
      <button
        class="text-theme-sm shadow-theme-xs inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
        <svg class="fill-white stroke-current dark:fill-gray-800" width="20" height="20" viewBox="0 0 20 20"
          fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M2.29004 5.90393H17.7067" stroke="" stroke-width="1.5" stroke-linecap="round"
            stroke-linejoin="round" />
          <path d="M17.7075 14.0961H2.29085" stroke="" stroke-width="1.5" stroke-linecap="round"
            stroke-linejoin="round" />
          <path
            d="M12.0826 3.33331C13.5024 3.33331 14.6534 4.48431 14.6534 5.90414C14.6534 7.32398 13.5024 8.47498 12.0826 8.47498C10.6627 8.47498 9.51172 7.32398 9.51172 5.90415C9.51172 4.48432 10.6627 3.33331 12.0826 3.33331Z"
            fill="" stroke="" stroke-width="1.5" />
          <path
            d="M7.91745 11.525C6.49762 11.525 5.34662 12.676 5.34662 14.0959C5.34661 15.5157 6.49762 16.6667 7.91745 16.6667C9.33728 16.6667 10.4883 15.5157 10.4883 14.0959C10.4883 12.676 9.33728 11.525 7.91745 11.525Z"
            fill="" stroke="" stroke-width="1.5" />
        </svg>
        Filter
      </button>
      <a class="bg-brand-500 text-theme-sm hover:bg-brand-600 shadow-theme-xs inline-flex items-center gap-2 rounded-lg border border-gray-300 px-4 py-2.5 font-medium text-white dark:border-gray-700"
        href="{{ route('activity.create') }}">
        <svg class="size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
          stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
        </svg>
        <span>Kegiatan Baru</span>
      </a>
    </div>
  </div>
  <div class="w-full overflow-x-auto">
    @if ($activities->isEmpty())
      <div class="py-4 text-center">
        <p class="text-gray-500 dark:text-gray-400">Belum Ada Kegiatan</p>
      </div>
    @else
      <table class="min-w-full">
        <thead>
          <tr class="border-y border-gray-100 dark:border-gray-800">
            <th class="py-3">
              <div class="flex items-center">
                <p class="text-theme-xs font-medium text-gray-500 dark:text-gray-400">
                  Nama Kegiatan
                </p>
              </div>
            </th>
            <th class="py-3">
              <div class="flex items-center">
                <p class="text-theme-xs font-medium text-gray-500 dark:text-gray-400">
                  Bentuk Kegiatan
                </p>
              </div>
            </th>
            <th class="py-3">
              <div class="flex items-center">
                <p class="text-theme-xs font-medium text-gray-500 dark:text-gray-400">
                  Status Publikasi
                </p>
              </div>
            </th>
            <th class="py-3">
              <div class="flex items-center">
                <p class="text-theme-xs font-medium text-gray-500 dark:text-gray-400">
                  Link Google Drive
                </p>
              </div>
            </th>
            <th class="py-3">
              <div class="col-span-2 flex items-center">
                <p class="text-theme-xs font-medium text-gray-500 dark:text-gray-400">
                  Aksi
                </p>
              </div>
            </th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
          @foreach ($activities as $activity)
            <tr>
              <td class="py-3">
                <div class="flex items-center">
                  <div class="flex items-center gap-3">
                    <div>
                      <p class="text-theme-sm font-medium text-gray-800 dark:text-white/90">
                        {{ Str::limit($activity->title, 25) }}
                      </p>
                      <span class="text-theme-xs text-gray-500 dark:text-gray-400">
                        {{ $activity->start_date->translatedFormat('d F Y') }}
                      </span>
                    </div>
                  </div>
                </div>
              </td>
              <td class="py-3">
                <div class="flex items-center">
                  <p class="text-theme-sm text-gray-500 dark:text-gray-400">
                    {{ Str::ucfirst($activity->type) }}
                  </p>
                </div>
              </td>
              <td class="py-3">
                <div class="flex items-center">
                  @if ($activity->published)
                    <span
                      class="bg-success-50 text-success-600 dark:bg-success-500/15 dark:text-success-500 inline-flex items-center justify-center gap-1 rounded-full px-2.5 py-0.5 text-sm font-medium">
                      Sudah Publikasi
                    </span>
                  @else
                    <span
                      class="bg-error-50 text-error-600 dark:bg-error-500/15 dark:text-error-500 inline-flex items-center justify-center gap-1 rounded-full px-2.5 py-0.5 text-sm font-medium">
                      Belum Publikasi
                    </span>
                  @endif
                </div>
              </td>
              <td class="py-3">
                <div class="flex items-center">
                  <a class="text-theme-sm text-gray-500 dark:text-gray-400"
                    href="https://drive.google.com/drive/folders/1QwFLkZ_eR4wcw2OV3XHHowhmaxITFfP5" target="_blank">
                    {{ Str::limit('https://drive.google.com/drive/folders/1QwFLkZ_eR4wcw2OV3XHHowhmaxITFfP5', 30) }}
                  </a>
                </div>
              </td>
              <td class="space-y-2 py-3">
                <div>
                  @if ($activity->published)
                    <button
                      class="bg-warning-500 hover:bg-warning-600 shadow-theme-xs inline-flex w-full items-center justify-center gap-2 rounded-lg border border-gray-300 px-4 py-2.5 text-white dark:border-gray-700"
                      wire:click="unpublish('{{ $activity->slug }}')">
                      <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                      </svg>
                      <span>Batalkan Publikasi</span>
                    </button>
                  @else
                    <button
                      class="bg-success-500 hover:bg-success-600 shadow-theme-xs inline-flex w-full items-center justify-center gap-2 rounded-lg border border-gray-300 px-4 py-2.5 text-white dark:border-gray-700"
                      wire:click="publish('{{ $activity->slug }}')">
                      <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                      </svg>
                      <span>Publikasi</span>
                    </button>
                  @endif
                </div>
                <div class="flex gap-2">
                  <button
                    class="bg-blue-light-500 hover:bg-blue-light-600 shadow-theme-xs inline-flex flex-1 items-center justify-center gap-2 rounded-lg border border-gray-300 px-4 py-2.5 text-white dark:border-gray-700">
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                      stroke-width="1.5" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round"
                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                    </svg>
                    <span>Edit</span>
                  </button>
                  <button
                    class="bg-error-500 hover:bg-error-600 shadow-theme-xs inline-flex flex-1 items-center justify-center gap-2 rounded-lg border border-gray-300 px-4 py-2.5 text-white dark:border-gray-700"
                    type="button" wire:click="hapus('{{ $activity->slug }}')"
                    wire:confirm="Apakah anda yakin ingin menghapus data ini?">
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                      stroke-width="1.5" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round"
                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                    </svg>
                    <span>Hapus</span>
                  </button>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      <div class="mt-4">
        {{ $activities->links() }}
      </div>
    @endif
  </div>
</div>
