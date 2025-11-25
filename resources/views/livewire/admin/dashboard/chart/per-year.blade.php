<div
  class="overflow-hidden rounded-2xl border border-gray-200 bg-white px-5 pt-5 sm:px-6 sm:pt-6 dark:border-gray-800 dark:bg-white/[0.03]">
  <div class="flex justify-between">
    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
      Total Kegiatan per Tahun
    </h3>
  </div>

  <div class="custom-scrollbar max-w-full overflow-x-auto">
    <div class="-ml-5 min-w-[650px] pl-2 xl:min-w-full">
      <div class="-ml-5 h-full min-w-[650px] pl-2 xl:min-w-full" id="perYear"></div>
    </div>
  </div>
</div>

@script
  <script>
    document.addEventListener("livewire:navigated", () => {
      let chartObject = null;

      function renderChart(years, data) {
        const el = document.getElementById("perYear");

        if (!el) {
          console.warn("perYear belum ada di DOM");
          return;
        }

        const options = {
          chart: {
            type: "bar",
            height: 300,
            stacked: true,
            toolbar: {
              show: false
            },
          },
          xaxis: {
            categories: years,
          },
          series: data,
        };

        // kalau chart sudah ada, update aj
        if (chartObject) {
          chartObject.updateOptions({
            xaxis: {
              categories: years
            },
            series: data,
          });
        } else {
          chartObject = new ApexCharts(el, options);
          chartObject.render();
        }
      }

      renderChart(@js($data['years']), @js($data['series']));
    });
  </script>
@endscript
