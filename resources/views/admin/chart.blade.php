<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
<canvas id="myChart" width="400" height="400"></canvas>

<script>
    // Any of the following formats may be used
    const CHART = document.getElementById('myChart');
    console.log(CHART)
    let lineChartt = new Chart(CHART, {
        type: 'line',
        data: {

            labels: ["{!! implode('", "', $labels) !!}"],
            datasets: [{
                label: ["{!! implode('", "', $labels) !!}"],
                data: ["{!! implode('", "', $data) !!}"],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]

        }
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.4.0/chart.esm.min.js"></script>

</body>

</html>
