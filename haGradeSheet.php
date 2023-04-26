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
            text-align: left;
            padding: 8px;
            border: 1px solid black
        }

        tr:nth-child(even) {
            background-color: white;
            color: black;
        }

        tr {
            background-color: #FAF9F6;
            color: black;
        }

        th {
            background-color: #032947;
            color: white;
            border: 1px solid black
        }

        .selectsectionha {
            margin-left: 50px;
            margin-top: 10px;
            height: 42px;
            width: 150px;
            background-color: #032947;
            color: white;
            font-weight: bolder;
            border-radius: 4px;
        }

        .selectidha {
            margin-left: 10px;
            margin-top: 10px;
            height: 42px;
            width: 150px;
            background-color: #032947;
            color: white;
            font-weight: bolder;
            border-radius: 4px;
        }

        .grade-generate-btn-ha {
            margin-left: 50px;
            margin-top: 10px;
            height: 42px;
            width: 150px;
            background-color: #032947;
            color: white;
            font-weight: bolder;
            border-radius: 4px;
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
    <div>
        <input type="text" id="section" name="section" placeholder="Enter Section" class="selectsectionha">
        <input type="text" id="courseID" name="courseID" placeholder="Enter Course ID" class="selectidha">
    </div>
    <div>
        <button id="submitha" class="grade-generate-btn-ha">Generate</button>
    </div>
    <div id="result-ha"></div>

    <script>
        $(document).ready(function() {
            $("#submitha").click(function() {
                var section = $("#section").val();
                var courseID = $("#courseID").val();
                $.ajax({
                    url: "gradeSheet.php?section=" + section + "&courseID=" + courseID,
                    type: "GET",
                    success: function(response) {
                        $("#result-ha").html(response);
                    }
                });
            });
        });
    </script>
</body>

</html>