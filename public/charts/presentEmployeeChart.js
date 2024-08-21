const attendanceChart = document.getElementById('attendanceChart').getContext('2d');
const attendance = new Chart(attendanceChart, {
    type: 'doughnut',
    data:{
        labels: [
          'present',
          'absent',
        ],
        datasets: [{
          label: 'employees',
          data: [300, 50],
          backgroundColor: [
            'rgb(75, 192, 192)',
            'rgb(255, 99, 132)'
          ],
          hoverOffset: 4
        }]
      }
});

const salaryChart = document.getElementById('salaryChart').getContext('2d');
const salary = new Chart(salaryChart, {
    type: 'doughnut',
    data:{
        labels: [
          "Paid Salaries",
          "Pending Salaries",
        ],
        datasets: [{
          label: 'employees',
          data: [100, 50],
          backgroundColor: [
            'rgb(54, 162, 235)',  
            'rgb(255, 206, 86)'
          ],
          hoverOffset: 4
        }]
      }
});

