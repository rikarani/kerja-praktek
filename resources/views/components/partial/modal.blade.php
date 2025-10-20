@props(['name'])

<div x-cloak x-data="{ open: false }" @open-modal.window="open = ($event.detail.modal === '{{ $name }}');"
  @close-modal.window="open = false;">
  <div class="modal z-99999 fixed inset-0 flex items-center justify-center overflow-y-auto p-5" x-show="open">
    <div class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]"></div>
    <div class="relative w-full max-w-[584px] rounded-3xl bg-white p-6 lg:p-10 dark:bg-gray-900"
      @click.outside="open = false">
      <button
        class="z-999 size-9.5 group absolute right-3 top-3 flex items-center justify-center rounded-full text-gray-500 transition-colors hover:bg-gray-300 hover:text-gray-500 sm:right-6 sm:top-6 sm:h-11 sm:w-11 dark:bg-gray-800 dark:hover:bg-gray-700"
        @click="open = false">
        <svg class="fill-current transition-colors group-hover:text-gray-600 dark:group-hover:text-gray-200"
          width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" clip-rule="evenodd"
            d="M6.04289 16.5413C5.65237 16.9318 5.65237 17.565 6.04289 17.9555C6.43342 18.346 7.06658 18.346 7.45711 17.9555L11.9987 13.4139L16.5408 17.956C16.9313 18.3466 17.5645 18.3466 17.955 17.956C18.3455 17.5655 18.3455 16.9323 17.955 16.5418L13.4129 11.9997L17.955 7.4576C18.3455 7.06707 18.3455 6.43391 17.955 6.04338C17.5645 5.65286 16.9313 5.65286 16.5408 6.04338L11.9987 10.5855L7.45711 6.0439C7.06658 5.65338 6.43342 5.65338 6.04289 6.0439C5.65237 6.43442 5.65237 7.06759 6.04289 7.45811L10.5845 11.9997L6.04289 16.5413Z"
            fill=""></path>
        </svg>
      </button>
      {{ $slot }}
    </div>
  </div>
</div>
