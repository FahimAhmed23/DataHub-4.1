<?php
include 'connect.php';
include "./utils/getPLOData.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CO wise PLO</title>

    <link rel="stylesheet" href="commonStdDashboard.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="std-menu-bar">
        <ul>
            <li><a href="std_dashboard.php" target="_self">Home</a></li>
            <li><a href="coWisePlo.php" target="_self">CO wise PLO Analysis</a></li>
            <!-- <li><a href="courseWisePlo.php" target="_self">Course wise PLO Analysis</a></li> -->
            <li><a href="PloAchievementTable.php" target="_self">PLO Achievement Table</a></li>
            <li><a href="overallPloAnalysis.php" target="_self">Overall PLO</a></li>
            <li><a href="courseOutline.php" target="_self">Course Outline</a></li>
            <button class="log-out" type="button"><a href="logout.php" target="_self">Log Out</a></button>
        </ul>
    </div>
    <div class="course-name">
        <button class="cse303" onclick="showCOWisePLOGraph('CSE303')">CSE303</button>
        <button class="cse203" onclick="showCOWisePLOGraph('CSE203')">CSE203</button>
        <button class="cse204" onclick="showCOWisePLOGraph('CSE204')">CSE204</button>
        <button class="cse211" onclick="showCOWisePLOGraph('CSE211')">CSE211</button>
    </div>
    <div class="chart-container" id="chart-container">
        <canvas id="myChart"></canvas>
    </div>

    <script>
        function showCOWisePLOGraph(courseId) {
            document.getElementById("chart-container").style.backgroundColor = "#fff";
            let data = [];

            data[0] = <?php echo $PLO2 ?>;
            data[1] = <?php echo $PLO3 ?>;
            data[2] = <?php echo $PLO4 ?>;
            data[3] = <?php echo $PLO6 ?>;
            const ctx = document.getElementById('myChart');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['CO1                PLO2', 'CO2               PLO3', 'CO3                PLO4', 'CO4                     PLO6'],
                    datasets: [{
                            label: 'CO %',
                            data: data,
                            borderWidth: 1
                        },
                        {
                            label: 'PLO %',
                            data: data,
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    scales: {
                        y: {
                            max: 100,
                            min: 0
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: (data) => {
                                    const {
                                        datasetIndex,
                                        dataIndex,
                                        raw
                                    } = data;
                                    let label = "";
                                    if (datasetIndex === 0) {
                                        label = `CO${dataIndex+1} ${raw.toFixed(2)}%`;
                                    } else if (datasetIndex === 1) {
                                        let PLOValue;
                                        PLOValue =
                                            dataIndex === 0 ?
                                            (PLOValue = 2) :
                                            dataIndex === 1 ?
                                            (PLOValue = 3) :
                                            dataIndex === 2 ?
                                            (PLOValue = 4) :
                                            dataIndex === 3 ?
                                            (PLOValue = 6) : "";
                                        label = `PLO${PLOValue} ${raw.toFixed(2)}%`;
                                    }
                                    return label;
                                }
                            }
                        }
                    }
                },
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            });
        }
    </script>
</body>

</html>