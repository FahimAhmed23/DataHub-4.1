<?php
include 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="script.js"></script>
    <title>Higher Authority Dashboard</title>
    <link rel="stylesheet" href="commonHaStyle.css">

    <style>
        table {
            border-collapse: collapse;
            width: 75%;
            margin-top: 50px;
            margin-left: 150px;
            border: 1px solid black
        }

        th,
        td {
            text-align: center;
            padding: 8px;
            border: 1px solid black
        }

        tr:nth-child(even) {
            background-color: white;
            color: black;
        }
        tr{
            background-color: #FAF9F6;
            color: black;
        }

        th {
            background-color: #032947;
            color: white;
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
                        <li><a href="haSchoolDeptProgramGpa.php">School/Dept Wise</a></li>
                        <li><a href="haCourseGpa.php">Course Wise</a></li>
                        <li><a href="haInstructorGpa.php">Instructor Wise</a></li>
                    </ul>
                </div>
            </li>
            <button class="log-out" type="button"><a href="logout.php" target="_self">Log Out</a></button>
        </ul>
    </div>
    <div>
        <button id="view-backlog-data" class="backlog-view-btn">View</button>
    </div>
    <div id = "backlog-table"></div>
    <script>
        $(document).ready(function(){
            $("#view-backlog-data").click(function(){
                $.ajax({
                    url: "getBacklogData.php",
                    type: "GET",
                    success: function(data){
                        $("#backlog-table").html(data);
                    }
                });
            });
        });
    </script>
</body>

</html>