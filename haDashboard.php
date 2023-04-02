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
    <title>Higher Authority Dashboard</title>
    <link rel="stylesheet" href="commonHaStyle.css">
</head>

<body>
    <div class="ha-menu-bar">
        <ul>
            <li><a href="haDashboard.php">Home</a></li>
            <li><a href="">Subject wise Analysis</a>
                <div class="analysis-sub-menu">
                    <ul>
                        <li><a href="gradeSheetAnalysis.php">Grade Sheet Analysis</a></li>
                        <li><a href="semesterWiseCloPloAnalysis.php">Semester wise CLO/PLO Analysis</a></li>
                    </ul>
                </div>
            </li>
            <li><a href="haStudentWiseCoPlo.php">Student wise CO/PLO Analysis</a></li>
            <li><a href=".php">Department wise CO/PLO</a></li>
            <li><a href=".php">School wise CO/PLO</a></li>
            <li><a href="enrollmentStats.php">Enrollment Stats</a></li>
            <button class="log-out" type="button"><a href="logout.php" target="_self">Log Out</a></button>
        </ul>
    </div>
    <div class="user-info">
        <p class="user-id">ID : <?php echo $stdId ?> </p>
        <p class="user-type">User Type : Higher Authority</p>
    </div>
</body>

</html>