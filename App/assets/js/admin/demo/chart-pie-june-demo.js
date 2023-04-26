(Chart.defaults.global.defaultFontFamily = "Nunito"),
  '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = "#858796";

let weeklyEarningChartJuneData = [];
weeklyEarningsJune.forEach(function (week) {
  weeklyEarningChartJuneData.push(week.total_amount);
});

var ctx = document.getElementById("myPieChartJune");
var myPieChart = new Chart(ctx, {
  type: "doughnut",
  data: {
    labels: ["1. hét", "2. hét", "3. hét", "4. hét", "5. hét"],
    datasets: [
      {
        data: weeklyEarningChartJuneData,
        backgroundColor: [
          "#ecd07c",
          "#b2985c",
          "#8d744e",
          "#E1C16E",
          "#C4A484",
        ],
        hoverBackgroundColor: [
          "#e2b93d",
          "#927b45",
          "#705c3e",
          "#d5a936",
          "#ae8357",
        ],
        hoverBorderColor: "rgba(234, 236, 244, 1)",
      },
    ],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: "#dddfeb",
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
      callbacks: {
        label: function (tooltipItem, data) {
          let dataset = data.datasets[tooltipItem.datasetIndex];
          let currentValue = dataset.data[tooltipItem.index];
          let formattedValue = number_format(currentValue);
          let label = data.labels[tooltipItem.index];
          return label + ": " + formattedValue + " Ft";
        },
      },
    },
    legend: {
      display: false,
    },
    cutoutPercentage: 80,
  },
});
