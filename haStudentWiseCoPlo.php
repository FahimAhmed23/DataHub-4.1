<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Studetn Wise Analysis</title>
    <link rel="stylesheet" href="commonHaStyle.css">
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
    <div class="search-id">
        <input type="text" id="studentId" name="studentId" class="id-entry" placeholder="Enter Student ID" required>
        <div class="choose-section">
            <input type="button" value="CSE303" class="cse303" onclick="">
            <input type="button" value="CSE310" class="cse310" onclick="">
        </div>
    </div>
</body>

</html>