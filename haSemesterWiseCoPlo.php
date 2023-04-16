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
    <title>Semester Wise</title>
    <link rel="stylesheet" href="commonHaStyle.css">
</head>

<body>
    <div class="ha-menu-bar">
        <ul>
            <li><a href="haDashboard.php">Home</a></li>
            <li><a href="">Subject wise Analysis</a>
                <div class="analysis-sub-menu">
                    <ul>
                        <li><a href="haGradeSheetAnalysis.php">Grade Sheet Analysis</a></li>
                        <li><a href="haSemesterWiseCoPlo.php">Semester wise CLO/PLO Analysis</a></li>
                    </ul>
                </div>
            </li>
            <li><a href="haStudentWiseCoPlo.php">Student wise CO/PLO Analysis</a></li>
            <li><a href="deptWiseCoPlo.php">Department wise CO/PLO</a></li>
            <li><a href="schoolWiseCoPlo.php">School wise CO/PLO</a></li>
            <li><a href="enrollmentStats.php">Enrollment Stats</a></li>
            <button class="log-out" type="button"><a href="logout.php" target="_self">Log Out</a></button>
        </ul>
    </div>
</body>

</html>