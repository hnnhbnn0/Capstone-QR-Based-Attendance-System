function randomInteger(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

$(function(){
    LoadDashboard();
})

function LoadDashboard(){
    $.ajax({
        url: '../../controller/admin/dashboard.php',
        method: '',
        data:{
            id: $('#account-id').val(),
            fetch: 'admin'
        },
        success: function(response){
            console.log(response)
            appendDashboard(response)
        }
    })
}

function appendDashboard(json){
    const res = JSON.parse(json)
    console.log(res)

    const config1 = {
        type: 'pie',
        data: {
            datasets: [{
                data: [res.student_active_count,res.student_inactive_count]
            }],
            labels: [
                res.student_active_count + ' Active',
                res.student_inactive_count + ' Inactive',
            ]
        },
        
        
        options: {
            responsive: true,
            plugins: {
                colorschemes: {
                    scheme: 'office.Sky6',
                },
            },
            legend: {
                display: true,
                position: 'bottom',
                labels: {
                fontColor: '#000',
                usePointStyle: false,
                boxWidth: 10,
            }
            },
        },
    };
    const config2 = {
        type: 'pie',
        data: {
            datasets: [{
                data: [res.faculty_active_count,res.faculty_inactive_count]
            }],
            labels: [
                res.faculty_active_count + ' Active',
                res.faculty_inactive_count + ' Inactive',
            ]
        },
        
        
        options: {
            responsive: true,
            plugins: {
                colorschemes: {
                    scheme: 'office.Sky6',
                },
            },
            legend: {
                display: true,
                position: 'bottom',
                labels: {
                fontColor: '#000',
                usePointStyle: false,
                boxWidth: 10,
            }
            },
        },
    };
    
    const config3 = {
        type: 'pie',
        data: {
            datasets: [{
                data: [res.student_count,res.faculty_count]
            }],
            labels: [
                res.student_count +  ' Student',
                res.faculty_count + ' Faculty',
            ]
        },
        
        
        options: {
            responsive: true,
            plugins: {
                colorschemes: {
                    scheme: 'office.Sky6',
                },
            },
            legend: {
                display: true,
                position: 'bottom',
                labels: {
                fontColor: '#000',
                usePointStyle: false,
                boxWidth: 10,
            }
            },
        },
    };
    
    console.log(res.active_count)
    const configLine = {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
            datasets: [
            {
                label: '1st Year',
                data: res.active_count,
                fill: false,
            }, 
            {
                label: '2nd Year',
                fill: false,
                data: res.active_count,
            },
            {
                label: '3rd Year',
                fill: false,
                data: res.active_count,
            },
            {
                label: '4th Year',
                fill: false,
                data: res.active_count,
            }
            
        ]
        },
        options: {
            responsive: true,
            title: {
            display: true,
            text: '',
            },
            tooltips: {
            mode: 'label',
            },
            hover: {
            mode: 'nearest',
            intersect: true
            },
            plugins: {
                colorschemes: {
                    scheme: 'office.Sky6',
                },
            },
            layout: {
                padding: {
                    top: -30
                }
            },
            scales: {
            xAxes: [{
                display: true,
                gridLines: {
                display: false,
                color: '#000'
                },
                scaleLabel: {
                display: false,
                labelString: 'Year -'
                }
            }],
            yAxes: [{
                display: true,
                gridLines: {
                display: false,
                color: '#000'
                },
                scaleLabel: {
                display: false,
                labelString: 'Value'
                },
            }]
            }
        },
    }

    console.log(res.active_count)
    const configLine1 = {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
            datasets: [
            {
                label: '1st Year',
                data: res.student_firstyear,
                fill: false,
            }, 
            {
                label: '2nd Year',
                fill: false,
                data: res.student_secondyear,
            },
            {
                label: '3rd Year',
                fill: false,
                data: res.student_thirdyear,
            },
            {
                label: '4th Year',
                fill: false,
                data: res.student_fourthyear,
            }
            
        ]
        },
        options: {
            responsive: true,
            title: {
            display: true,
            text: '',
            },
            tooltips: {
            mode: 'label',
            },
            hover: {
            mode: 'nearest',
            intersect: true
            },
            plugins: {
                colorschemes: {
                    scheme: 'office.Sky6',
                },
            },
            layout: {
                padding: {
                    top: -30
                }
            },
            scales: {
            xAxes: [{
                display: true,
                gridLines: {
                display: false,
                color: '#000'
                },
                scaleLabel: {
                display: false,
                labelString: 'Year -'
                }
            }],
            yAxes: [{
                display: true,
                ticks: {
                    beginAtZero: true,
                                steps: 10,
                                stepValue: 5,
                                max: 100
                },
                gridLines: {
                display: false,
                color: '#000'
                },
                scaleLabel: {
                display: false,
                labelString: 'Value'
                
                },
            }]
            }
        },
    }
    
    var canvas1 = document.getElementById('chart1').getContext('2d')
    var chart1 = new Chart(canvas1, config1);
    var canvas2 = document.getElementById('chart2').getContext('2d')
    var chart2 = new Chart(canvas2, config2);
    var canvas3 = document.getElementById('chart3').getContext('2d')
    var chart3 = new Chart(canvas3, config3);
    var canvas4 = document.getElementById('chart4').getContext('2d')
    var chart4 = new Chart(canvas4, configLine);
  
    var canvas6 = document.getElementById('chart6').getContext('2d')
    var chart5 = new Chart(canvas6, configLine1);
    
    $('#tot-stud').text(res.student_count)
    $('#tot-fac').text(res.faculty_count)
}