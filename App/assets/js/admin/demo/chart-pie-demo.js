// Set new default font family and font color to mimic Bootstrap's default styling
(Chart.defaults.global.defaultFontFamily = "Nunito"),
  '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = "#858796";

// Pie Chart Example
var ctx = document.getElementById("myPieChartCategories");
var myPieChart = new Chart(ctx, {
  type: "doughnut",
  data: {
    labels: [
      "Lángosok",
      "Frissensültek",
      "Hamburgerek",
      "Hot-dogok",
      "Köretek",
      "Desszertek",
      "Alkoholos italok",
      "Üdítők",
      "Öntetek",
    ],
    datasets: [
      {
        data: categoryCount,
        backgroundColor: [
          "#e4b159",
          "#dd975e",
          "#654227",
          "#d39459",
          "#d7ae74",
          "#e0bd98",
          "#3d7b65",
          "#bb373a",
          "#d7d4cd",
        ],
        hoverBackgroundColor: [
          "#e1a847",
          "#d98b4c",
          "#542d0f",
          "#be8550",
          "#d3a564",
          "#ddb68d",
          "#276c54",
          "#962c2e",
          "#d2cfc7",
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
    },
    legend: {
      display: false,
    },
    cutoutPercentage: 80,
  },
});
