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
            <li class="hello"><a href="std_dashboard.php">Home</a></li>
            <li><a href="coWisePlo.php">CO wise PLO Analysis</a></li>
            <li><a href="spiderChartAnalysis.php" target="_self">Spider Chart Analysis</a></li>
            <li><a href="courseWisePloAnalysis.php">Course Wise PLO</a></li>
            <li><a href="stdGradeSheet.php">Grade Sheet</a></li>
            <li><a href="courseOutline.php">Course Outline</a></li>
            <button class="log-out" type="button"><a href="logout.php" target="_self">Log Out</a></button>
        </ul>
    </div>
    <div>
        <select name="courseID" class="select1" id="CSECourseSelection">
            <option disabled selected>Select Course</option>
            <option value="CSC101">CSC101</option>
            <option value="CSE203">CSE203</option>
            <option value="CSE303">CSE303</option>
        </select>
        <button class="cse303" onclick="showCOWisePLOGraph()">View</button>
    </div>

    <div class="chart-container" id="chart-container"></div>

    <script>
        let chartObject;

        function createGraph(data, courseId) {
            const ctx = document.getElementById(`chart-${courseId}`);
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
                },
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            });
            chartObject = ctx;
        }

        function createCanvasElement(id) {
            const canvasWrapper = document.getElementById("chart-container");
            const canvas = document.createElement("canvas");
            canvas.setAttribute("id", `chart-${id}`);
            canvasWrapper.appendChild(canvas);
        }

        function showCOWisePLOGraph() {
            let courseId = document.getElementById("CSECourseSelection").value;
            document.getElementById("chart-container").innerHTML = "";
            createCanvasElement(courseId);

            document.getElementById("chart-container").style.backgroundColor = "#fff";
            let data;

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    data = xmlhttp.responseText.split("-");
                    createGraph(data, courseId);
                }
            };
            var url = "";
            url = "./utils/getPLOData.php?courseId=" + courseId;
            xmlhttp.open("POST", url, true);
            xmlhttp.send();
        }
    </script>
</body>

</html>