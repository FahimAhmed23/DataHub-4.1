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

    <link rel="stylesheet" href="commonStdDashboard.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="std-menu-bar">
        <ul>
            <li><a href="std_dashboard.php" target="_self">Home</a></li>
            <li><a href="coWisePlo.php" target="_self">CO wise PLO Analysis</a></li>
            <!-- <li><a href="courseWisePlo.php" target="_self">Course wise PLO Analysis</a></li> -->
            <li><a href="spiderChartAnalysis.php" target="_self">Spider Chart Analysis</a></li>
            <li><a href="overallPloAnalysis.php" target="_self">Overall PLO</a></li>
            <li><a href="courseOutline.php" target="_self">Course Outline</a></li>
            <button class="log-out" type="button"><a href="logout.php" target="_self">Log Out</a></button>
        </ul>
    </div>
    <div>
        <select name="courseID" class="select1" id="CSECourseSelection-2">
            <option disabled selected>Select Course</option>
            <option value="CSC101">CSC101</option>
            <option value="CSE203">CSE203</option>
            <option value="CSE303">CSE303</option>
        </select>
        <button class="cse303" onclick="showPLOGraph()">View</button>
    </div>

    <div id="chart-container-overall" class="chart-container">
    </div>

    <script>
        let chartObject;

        function createGraph(data, courseId) {
            const ctxOverall = document.getElementById(`overallPLO-${courseId}`);
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
            chartObject = ctxOverall;
        }

        function createCanvasElement(id) {
            const canvasWrapper = document.getElementById("chart-container-overall");
            const canvas = document.createElement("canvas")
            canvas.setAttribute("id", `overallPLO-${id}`);
            canvasWrapper.appendChild(canvas);
        }

        function showPLOGraph() {
            let courseId = document.getElementById("CSECourseSelection-2").value;
            document.getElementById("chart-container-overall").innerHTML = "";
            createCanvasElement(courseId);

            document.getElementById("chart-container-overall").style.backgroundColor = "#fff";
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