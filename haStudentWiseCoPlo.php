<?php
session_start();
$haId = $_SESSION['ID'];
/* $usertype = $_SESSION['userType']; */
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Higher Authority Dashboard</title>
    <link rel="stylesheet" href="commonHaStyle.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .chart-container-ha {
            height: 450px;
            width: 800px;
            margin-left: 400px;
            margin-bottom: 20px;
        }

        .ha-course-selection {
            margin-left: 50px;
            margin-top: 10px;
            height: 42px;
            width: 150px;
            background-color: #032947;
            color: white;
            font-weight: bolder;
            border-radius: 4px;
        }

        .ha-id-entry {
            height: 40px;
            border-radius: 3px;
            background-color: #002745;
            color: white;
            margin-left: 50px;
            margin-top: 25px;
        }
    </style>
</head>

<body>
    <div class="ha-menu-bar">
        <ul>
            <li><a href="haDashboard.php">Home</a></li>
            <li><a href="">Student Analysis</a>
                <div class="analysis-sub-menu">
                    <ul>
                        <li><a href="haGradeSheet.php">Grade Sheet</a></li>
                        <li><a href="haStudentWiseCoPlo.php">Student PLO</a></li>
                    </ul>
                </div>
            </li>
            <li><a href="">PLO Comparison</a>
                <div class="analysis-sub-menu">
                    <ul>
                        <li><a href="haCourseWiseComparison.php">Course Wise</a></li>
                        <li><a href="haProgramWiseComparison.php">Program Wise</a></li>
                        <li><a href="haSchoolWiseComparison.php">School Wise</a></li>
                    </ul>
                </div>
            </li>
            <li><a href="backlogData.php">Backlog Data</a></li>
            <li><a href="enrollmentStats.php">Enrollment Stats</a></li>
            <li><a href="">GPA Analysis</a>
                <div class="analysis-sub-menu">
                    <ul>
                        <li><a href="haschoolDeptProgramGpa.php">School/Dept Wise</a></li>
                        <li><a href="haCourseGpa.php">Course Wise</a></li>
                        <li><a href="haInstructorGpa.php">Instructor Wise</a></li>
                    </ul>
                </div>
            </li>
            <button class="log-out" type="button"><a href="logout.php" target="_self">Log Out</a></button>
        </ul>
    </div>
    <div class="ha-search-id">
        <input type="text" id="selectStudentIdHa" name="studentId" class="ha-id-entry" placeholder="Enter Student ID" required>
    </div>
    <div>
        <select name="courseID" class="ha-course-selection" id="courseSelectionHa">
            <option disabled selected>Select Course</option>
            <option value="CSC101">CSC101</option>
            <option value="CSE203">CSE203</option>
            <option value="CSE303">CSE303</option>
        </select>
        <button class="cse303" onclick="showCOWisePLOGraphHa()">View</button>
    </div>

    <div class="chart-container-ha" id="ha-chart-container"></div>

    <script>
        let chartObjectHa;

        function createGraph(data, courseId, studentId) {
            const ctxHa = document.getElementById(`HaChart-${courseId}-${studentId}`);
            new Chart(ctxHa, {
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
            chartObjectHa = ctxHa;
        }

        function createCanvasElement(courseId, studentId) {
            const canvasWrapper = document.getElementById("ha-chart-container");
            const canvas = document.createElement("canvas");
            canvas.setAttribute("id", `HaChart-${courseId}-${studentId}`);
            canvasWrapper.appendChild(canvas);
        }

        function showCOWisePLOGraphHa() {
            let courseId = document.getElementById("courseSelectionHa").value;
            let studentId = document.getElementById("selectStudentIdHa").value;
            document.getElementById("ha-chart-container").innerHTML = "";
            createCanvasElement(courseId, studentId);

            document.getElementById("ha-chart-container").style.backgroundColor = "#fff";
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