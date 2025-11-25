<div
  class="overflow-hidden rounded-2xl border border-gray-200 bg-white px-5 pt-5 sm:px-6 sm:pt-6 dark:border-gray-800 dark:bg-white/[0.03]">
  <div class="flex justify-between">
    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
      Kegiatan Per Bulan
    </h3>

    <div class="relative z-20 bg-transparent" wire:ignore>
      <select
        class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 focus:ring-3 focus:outline-hidden w-full appearance-none rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 pr-10 text-sm text-gray-800 placeholder:text-gray-400 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
        required wire:model.live="selectedYear">
        @foreach ($years as $year)
          <option class="text-gray-700 dark:bg-gray-900 dark:text-gray-400" value="{{ $year }}"
            wire:click="$refresh" wire:key="{{ $year }}">
            {{ $year }}
          </option>
        @endforeach
      </select>
      <span class="pointer-events-none absolute right-4 top-1/2 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
        <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none"
          xmlns="http://www.w3.org/2000/svg">
          <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5"
            stroke-linecap="round" stroke-linejoin="round" />
        </svg>
      </span>
    </div>
  </div>

  <div class="custom-scrollbar max-w-full overflow-x-auto">
    <div class="-ml-5 min-w-[650px] pl-2 xl:min-w-full">
      <div class="-ml-5 h-full min-w-[650px] pl-2 xl:min-w-full" id="perMonth"></div>
    </div>
  </div>
</div>

@script
  <script>
    let chartObject = null;

    function renderChart(months, series) {
      const el = document.getElementById("perMonth");
      if (!el) return;

      // destroy chart lama
      if (chartObject) {
        chartObject.destroy();
        chartObject = null;
      }

      chartObject = new ApexCharts(el, {
        chart: {
          type: "bar",
          height: 300,
          stacked: true,
          toolbar: {
            show: false
          },
        },
        xaxis: {
          categories: months
        },
        series: series,
      });

      chartObject.render();

      // FIX: ApexCharts kadang invisible → trigger resize setelah render
      setTimeout(() => {
        window.dispatchEvent(new Event('resize'));
      }, 50);
    }

    // initial render
    document.addEventListener("livewire:initialized", () => {
      renderChart(@js($data['months']), @js($data['series']));
    });

    // render pas ganti tahun
    Livewire.on("update-chart", (payload) => {
      renderChart(payload.data.months, payload.data.series);
    })
  </script>
@endscript
