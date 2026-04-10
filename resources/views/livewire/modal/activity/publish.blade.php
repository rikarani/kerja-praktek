<x-partial.modal name="publish-activity">
  <div class="text-center">
    <div class="z-1 relative mb-7 flex items-center justify-center">
      <svg class="fill-blue-light-50 dark:fill-blue-light-500/15" width="90" height="90" viewBox="0 0 90 90"
        fill="none" xmlns="http://www.w3.org/2000/svg">
        <path
          d="M34.364 6.85053C38.6205 -2.28351 51.3795 -2.28351 55.636 6.85053C58.0129 11.951 63.5594 14.6722 68.9556 13.3853C78.6192 11.0807 86.5743 21.2433 82.2185 30.3287C79.7862 35.402 81.1561 41.5165 85.5082 45.0122C93.3019 51.2725 90.4628 63.9451 80.7747 66.1403C75.3648 67.3661 71.5265 72.2695 71.5572 77.9156C71.6123 88.0265 60.1169 93.6664 52.3918 87.3184C48.0781 83.7737 41.9219 83.7737 37.6082 87.3184C29.8831 93.6664 18.3877 88.0266 18.4428 77.9156C18.4735 72.2695 14.6352 67.3661 9.22531 66.1403C-0.462787 63.9451 -3.30193 51.2725 4.49185 45.0122C8.84391 41.5165 10.2138 35.402 7.78151 30.3287C3.42572 21.2433 11.3808 11.0807 21.0444 13.3853C26.4406 14.6722 31.9871 11.951 34.364 6.85053Z"
          fill="" fill-opacity=""></path>
      </svg>
      <span class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2">
        <svg class="fill-blue-light-500 dark:fill-blue-light-500" width="38" height="38" viewBox="0 0 38 38"
          fill="none" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" clip-rule="evenodd"
            d="M5.85547 18.9998C5.85547 11.7396 11.7411 5.854 19.0013 5.854C26.2615 5.854 32.1471 11.7396 32.1471 18.9998C32.1471 26.2601 26.2615 32.1457 19.0013 32.1457C11.7411 32.1457 5.85547 26.2601 5.85547 18.9998ZM19.0013 2.854C10.0842 2.854 2.85547 10.0827 2.85547 18.9998C2.85547 27.9169 10.0842 35.1457 19.0013 35.1457C27.9184 35.1457 35.1471 27.9169 35.1471 18.9998C35.1471 10.0827 27.9184 2.854 19.0013 2.854ZM16.9999 11.9145C16.9999 13.0191 17.8953 13.9145 18.9999 13.9145H19.0015C20.106 13.9145 21.0015 13.0191 21.0015 11.9145C21.0015 10.81 20.106 9.91454 19.0015 9.91454H18.9999C17.8953 9.91454 16.9999 10.81 16.9999 11.9145ZM19.0014 27.8171C18.173 27.8171 17.5014 27.1455 17.5014 26.3171V17.3293C17.5014 16.5008 18.173 15.8293 19.0014 15.8293C19.8299 15.8293 20.5014 16.5008 20.5014 17.3293L20.5014 26.3171C20.5014 27.1455 19.8299 27.8171 19.0014 27.8171Z"
            fill=""></path>
        </svg>
      </span>
    </div>
    <h4 class="sm:text-title-sm mb-2 text-2xl font-semibold text-gray-800 dark:text-white/90">
      Konfirmasi Publish
    </h4>
    <p class="text-sm leading-6 text-gray-500 dark:text-gray-400">
      Apakah Anda yakin ingin mempublikasikan kegiatan <span class="font-semibold">{{ $activity?->title }}</span>?
    </p>
    <p class="text-sm leading-6 text-gray-500 dark:text-gray-400">
      Setelah dipublikasikan, kegiatan akan terlihat oleh semua pengguna.
    </p>
    <div class="mt-7 flex w-full items-center justify-center gap-3">
      <button
        class="bg-blue-light-500 shadow-theme-xs hover:bg-blue-light-600 flex w-full items-center justify-center gap-2 rounded-lg px-4 py-3 text-sm font-medium text-white sm:w-auto"
        type="button" wire:click="publish">
        <div role="status" wire:loading wire:target="publish">
          <svg class="inline size-5 animate-spin fill-gray-600 text-gray-200 dark:fill-gray-300 dark:text-gray-600"
            aria-hidden="true" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
              fill="currentColor" />
            <path
              d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
              fill="currentFill" />
          </svg>
          <span class="sr-only">Loading...</span>
        </div>
        <span>Publish Kegiatan</span>
      </button>
    </div>
  </div>
</x-partial.modal>
