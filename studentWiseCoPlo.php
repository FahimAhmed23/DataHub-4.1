<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Wise CO/PLO</title>
    <link rel="stylesheet" href="commonFacultyDashboard.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .chart-container-faculty{
            height: 450px;
            width: 800px;
            margin-left: 400px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="faculty-menu-bar">
        <ul>
            <li><a href="facultyDashboard.php">Home</a></li>
            <li><a href="gradeSheetAnalysis.php">Grade Sheet</a></li>
            <li><a href="studentWiseCoPlo.php">Student wise CO/PLO Analysis</a></li>
            <li><a href="dataEntry.php">Data Entry</a>
                <div class="data-entry-sub-menu">
                    <ul>
                        <li><a href="createOutline.php">Create Course Outline</a></li>
                        <li><a href="gradeInput.php">Grade Input</a></li>
                        <li><a href="">Add Exam</a></li>
                    </ul>
                </div>
            </li>
            <button class="log-out" type="button"><a href="logout.php" target="_self">Log Out</a></button>
        </ul>
    </div>
    <div class="search-id">
        <input type="text" id="selectStudentID" name="studentId" class="id-entry" placeholder="Enter Student ID" required>
    </div>
    <div>
        <select name="courseID" class="select1" id="courseSelection">
            <option disabled selected>Select Course</option>
            <option value="CSE303">CSE303</option>
        </select>
        <button class="cse303" onclick="showCOWisePLOGraph()">View</button>
    </div>

    <div class="chart-container-faculty" id="faculty-chart-container"></div>

    <script>
        let chartObjectFaculty;

        function createGraph(data, courseId, studentId) {
            const ctxFaculty = document.getElementById(`FacultyChart-${courseId}-${studentId}`);
            new Chart(ctxFaculty, {
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
            chartObjectFaculty = ctxFaculty;
        }

        function createCanvasElement(courseId, studentId) {
            const canvasWrapper = document.getElementById("faculty-chart-container");
            const canvas = document.createElement("canvas");
            canvas.setAttribute("id", `FacultyChart-${courseId}-${studentId}`);
            canvasWrapper.appendChild(canvas);
        }

        function showCOWisePLOGraph() {
            let courseId = document.getElementById("courseSelection").value;
            let studentId = document.getElementById("selectStudentID").value;
            document.getElementById("faculty-chart-container").innerHTML = "";
            createCanvasElement(courseId, studentId);

            document.getElementById("faculty-chart-container").style.backgroundColor = "#fff";
            let data;

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    data = xmlhttp.responseText.split("-");
                    createGraph(data, courseId, studentId);
                }
            };
            var url = "";
            url = "./utils/getPLOData.php?courseId=" + courseId + "&studentId=" + studentId;
            xmlhttp.open("GET", url, true);
            xmlhttp.send();
        }
    </script>
</body>

</html>