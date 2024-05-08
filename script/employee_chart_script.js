const payslipchart = document.getElementById('payslipChart');
var payslipChart =  new Chart(payslipchart, {
    type: 'doughnut',
    data: {
      datasets: [{
        label: 'My First Dataset',
        data: [20000, 3000],
        backgroundColor: [
          'rgb(128, 0, 0)',
          'rgb(30, 144, 255)',
        ],
        hoverOffset: 4
      }]
    }
  }); 