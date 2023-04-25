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
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="commonStdDashboard.css">
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
    <div class="user-info">
        <p class="user-id">ID : <?php echo $stdId ?> </p>
        <p class="user-type">User Type : Student</p>
    </div>
</body>

</html>