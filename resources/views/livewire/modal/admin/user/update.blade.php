<x-partial.modal name="update-user">
  <form wire:submit="submit">
    <h4 class="mb-6 text-lg font-medium text-gray-800 dark:text-white/90">
      Tambah User Baru
    </h4>
    <div class="flex flex-col gap-x-6 gap-y-5">
      <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
          Nama Lengkap
        </label>
        <input
          class="{{ twMerge(['disabled:opacity-50 shadow-theme-xs focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30', $errors->has('name') ? 'border-error-300 focus:border-error-300 focus:ring-error-500/10 dark:border-error-700 dark:focus:border-error-800' : '']) }}"
          type="text" wire:target="submit" required wire:loading.attr="disabled" wire:model="name"
          placeholder="udin petot">
        @error('name')
          <p class="text-theme-xs text-error-500 mt-1.5">
            {{ $message }}
          </p>
        @enderror
      </div>
      <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
          Username
        </label>
        <input
          class="{{ twMerge(['disabled:opacity-50 shadow-theme-xs focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30', $errors->has('email') ? 'border-error-300 focus:border-error-300 focus:ring-error-500/10 dark:border-error-700 dark:focus:border-error-800' : '']) }}"
          type="text" wire:target="submit" required wire:loading.attr="disabled" wire:model="username"
          placeholder="udinpetot">
        @error('username')
          <p class="text-theme-xs text-error-500 mt-1.5">
            {{ $message }}
          </p>
        @enderror
      </div>
      <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
          Email
        </label>
        <input
          class="{{ twMerge(['disabled:opacity-50 shadow-theme-xs focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30', $errors->has('email') ? 'border-error-300 focus:border-error-300 focus:ring-error-500/10 dark:border-error-700 dark:focus:border-error-800' : '']) }}"
          type="text" wire:target="submit" required wire:loading.attr="disabled" wire:model="email"
          placeholder="udinpetot@gmail.com">
        @error('email')
          <p class="text-theme-xs text-error-500 mt-1.5">
            {{ $message }}
          </p>
        @enderror
      </div>
      <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
          Role
        </label>
        <div class="relative z-20 bg-transparent">
          <select
            class="{{ twMerge(['disabled:opacity-50 shadow-theme-xs w-full border border-gray-300 dark:border-gray-700 dark:bg-gray-900 focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 rounded-lg bg-transparent px-4 py-2.5 pr-10 appearance-none text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:text-white/90 dark:placeholder:text-white/30', $errors->has('role_id') ? 'border-error-300 focus:border-error-300 focus:ring-error-500/10 dark:border-error-700 dark:focus:border-error-800' : '']) }}"
            wire:model="role_id">
            <option class="text-gray-700 dark:bg-gray-900 dark:text-gray-400" value="" disabled>
              Pilih Role
            </option>
            @foreach ($roles as $role)
              <option class="text-gray-700 dark:bg-gray-900 dark:text-gray-400" value="{{ $role->id }}">
                {{ $role->name }}
              </option>
            @endforeach
          </select>
          @if ($errors->has('role_id'))
            <span class="absolute right-3.5 top-1/2 -translate-y-1/2">
              <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M2.58325 7.99967C2.58325 5.00813 5.00838 2.58301 7.99992 2.58301C10.9915 2.58301 13.4166 5.00813 13.4166 7.99967C13.4166 10.9912 10.9915 13.4163 7.99992 13.4163C5.00838 13.4163 2.58325 10.9912 2.58325 7.99967ZM7.99992 1.08301C4.17995 1.08301 1.08325 4.17971 1.08325 7.99967C1.08325 11.8196 4.17995 14.9163 7.99992 14.9163C11.8199 14.9163 14.9166 11.8196 14.9166 7.99967C14.9166 4.17971 11.8199 1.08301 7.99992 1.08301ZM7.09932 5.01639C7.09932 5.51345 7.50227 5.91639 7.99932 5.91639H7.99999C8.49705 5.91639 8.89999 5.51345 8.89999 5.01639C8.89999 4.51933 8.49705 4.11639 7.99999 4.11639H7.99932C7.50227 4.11639 7.09932 4.51933 7.09932 5.01639ZM7.99998 11.8306C7.58576 11.8306 7.24998 11.4948 7.24998 11.0806V7.29627C7.24998 6.88206 7.58576 6.54627 7.99998 6.54627C8.41419 6.54627 8.74998 6.88206 8.74998 7.29627V11.0806C8.74998 11.4948 8.41419 11.8306 7.99998 11.8306Z"
                  fill="#F04438"></path>
              </svg>
            </span>
          @else
            <span
              class="pointer-events-none absolute right-4 top-1/2 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
              <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5"
                  stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </span>
          @endif
        </div>
        @error('role_id')
          <p class="text-theme-xs text-error-500 mt-1.5">
            {{ $message }}
          </p>
        @enderror
      </div>
      <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
          Password
        </label>
        <input
          class="{{ twMerge(['disabled:opacity-50 shadow-theme-xs focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30', $errors->has('password') ? 'border-error-300 focus:border-error-300 focus:ring-error-500/10 dark:border-error-700 dark:focus:border-error-800' : '']) }}"
          type="password" wire:target="submit" wire:loading.attr="disabled" wire:model="password"
          placeholder="********">
        <p class="text-theme-xs text-error-500 mt-1.5">
          opsional, jika tidak diisi maka defaultnya adalah "password"
        </p>
        @error('password')
          <p class="text-theme-xs text-error-500 mt-1.5">
            {{ $message }}
          </p>
        @enderror
      </div>
    </div>
    <div class="mt-6 flex w-full items-center justify-end gap-3">
      <button
        class="bg-brand-500 shadow-theme-xs hover:bg-brand-600 flex w-full items-center justify-center gap-2 rounded-lg px-4 py-3 text-sm font-medium text-white sm:w-auto"
        type="submit">
        <div role="status" wire:loading wire:target="submit">
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
        <span wire:loading.remove wire:target="submit">
          <svg class="size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
          </svg>
        </span>
        <span>Simpan</span>
      </button>
    </div>
  </form>
</x-partial.modal>
