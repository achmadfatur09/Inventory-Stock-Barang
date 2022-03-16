// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';


// Pie Chart Example
var ctx = document.getElementById("myPieChart");

var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: chart_labels_pie,
    datasets: [{
      data: chart_datas_pie,
      backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#6c757d', '#ffc107', '#fd7e14', '#212529'],
      hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf', '#adb5bd', '#ffb107', '#fd6e04', '#343a40'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: true,
      position: "bottom",
      labels:{
        usePointStyle: true,
      }
    },
    cutoutPercentage: 80,
  },
});
