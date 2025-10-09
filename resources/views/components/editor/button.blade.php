@props(['action', 'name'])

<div>
  <button
    class="cursor-pointer rounded-sm p-1.5 text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
    data-tooltip-target="tooltip-{{ $name }}" type="button" {{ $attributes }} @click="{{ $action }}">
    {{ $slot }}
    <span class="sr-only">{{ $name }}</span>
  </button>
  <div
    class="shadow-xs tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 transition-opacity duration-300 dark:bg-gray-700"
    id="tooltip-{{ $name }}" role="tooltip">
    {{ $name }}
    <div class="tooltip-arrow" data-popper-arrow></div>
  </div>
</div>
