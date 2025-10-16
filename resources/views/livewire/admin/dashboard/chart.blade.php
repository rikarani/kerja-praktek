<div
  class="overflow-hidden rounded-2xl border border-gray-200 bg-white px-5 pt-5 sm:px-6 sm:pt-6 dark:border-gray-800 dark:bg-white/[0.03]">
  <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
    Kegiatan Tiap Bulan
  </h3>
  <div class="custom-scrollbar max-w-full overflow-x-auto">
    <div class="-ml-5 min-w-[650px] pl-2 xl:min-w-full">
      <div class="-ml-5 h-full min-w-[650px] pl-2 xl:min-w-full" id="chartOne"></div>
    </div>
  </div>
</div>

@script
  <script>
    document.addEventListener('livewire:initialized', function() {
      const months = @js(array_keys($sales));
      const counts = @js(array_values($sales));

      const options = {
        series: [{
          name: "Kegiatan",
          data: counts
        }],
        colors: ["#465fff"],
        chart: {
          fontFamily: "Outfit, sans-serif",
          type: "bar",
          height: 300,
          toolbar: {
            show: false
          },
          events: {
            dataPointSelection: function(event, context, options) {
              window.location.href = `/admin/kegiatan?bulan=${months[options.dataPointIndex]}`
            }
          }
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: "20%",
            borderRadius: 5,
            borderRadiusApplication: "end",
          },
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          show: true,
          width: 4,
          colors: ["transparent"],
        },
        xaxis: {
          categories: months,
          axisBorder: {
            show: false
          },
          axisTicks: {
            show: false
          }
        },
        yaxis: {
          stepSize: 1,
        },
        fill: {
          opacity: 1
        },
        tooltip: {
          marker: {
            show: false
          },
          y: {
            formatter: function(value) {
              return `${value} Kegiatan`;
            },
            title: {
              formatter: function(value) {
                return "Ada";
              }
            }
          }
        }
      };

      const element = document.getElementById('chartOne');
      if (element) {
        const chart = new ApexCharts(element, options);
        chart.render();
      }
    });
  </script>
@endscript
