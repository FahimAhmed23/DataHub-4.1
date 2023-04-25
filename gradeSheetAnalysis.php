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
    <title>Grade Sheet Analysis</title>
    <link rel="stylesheet" href="commonFacultyDashboard.css">
    <style>
        table {
            border-collapse: collapse;
            width: 75%;
            margin-top: 50px;
            margin-left: 150px;
        }

        th,
        td {
            text-align: left;
            padding: 8px;
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

    <div>
        <input type="text" id="section" name="section" placeholder="Enter Section" class="select1">
        <input type="text" id="courseID" name="courseID" placeholder="Enter Course ID" class="select2">
    </div>
    <div>
        <button id="submit" class="grade-generate-btn">Generate</button>
    </div>
    <div id="result"></div>

    <script>
        $(document).ready(function() {
            $("#submit").click(function() {
                var section = $("#section").val();
                var courseID = $("#courseID").val();
                $.ajax({
                    url: "gradeSheet.php?section=" + section + "&courseID=" + courseID,
                    type: "GET",
                    success: function(response) {
                        $("#result").html(response);
                    }
                });
            });
        });
    </script>
</body>

</html>