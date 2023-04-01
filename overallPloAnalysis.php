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
    <title>Overall PLO Analysis</title>

    <link rel="stylesheet" href="overallPloAnalysis.css">

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
        <button class="cse303" onclick="showPLOGraph('CSE303')">CSE303</button>
        <button class="cse203" onclick="showPLOGraph('CSE203')">CSE203</button>
        <button class="cse204" onclick="showPLOGraph('CSE204')">CSE204</button>
        <button class="cse211" onclick="showPLOGraph('CSE211')">CSE211</button>
    </div>
    <div id="chart-container-overall" class="chart-container">
        <canvas id="myChart-overall"></canvas>
    </div>

    <script>
        function showPLOGraph(courseId) {
            document.getElementById("chart-container-overall").style.backgroundColor = "#fff";
            let data = [];

            data[0] = <?php echo $PLO2 ?>;
            data[1] = <?php echo $PLO3 ?>;
            data[2] = <?php echo $PLO4 ?>;
            data[3] = <?php echo $PLO6 ?>;

            console.log(data)
            const ctxOverall = document.getElementById('myChart-overall');
            new Chart(ctxOverall, {
                type: 'bar',
                data: {
                    labels: ['PLO2', 'PLO3', 'PLO4', 'PLO6'],
                    datasets: [{
                        label: 'PLO %',
                        data: data,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            max: 100,
                            min: 0
                        }
                    }
                },
                responsive: true,
                maintainAspectRatio: false,
                width: "500px",
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