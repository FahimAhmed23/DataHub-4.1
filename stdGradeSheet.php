<?php
session_start();
$stdId = $_SESSION['ID'];
/* $usertype = $_SESSION['userType']; */
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="script.js"></script>
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="commonStdDashboard.css">

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
        <button id="view-std-gradesheet" class="std-gradesheet">View</button>
    </div>
    <div id="std-gradesheet"></div>

    <script>
        $(document).ready(function() {
            $("#view-std-gradesheet").click(function() {
                $.ajax({
                    url: "getStdGrade.php",
                    type: "GET",
                    success: function(data) {
                        $("#std-gradesheet").html(data);
                    }
                });
            });
        });
    </script>
</body>

</html>