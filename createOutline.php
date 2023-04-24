<?php
    include 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Create Outline</title>
    <link rel="stylesheet" href="commonFacultyDashboard.css">
</head>

<body>
    <div class="faculty-menu-bar">
        <ul>
            <li><a href="facultyDashboard.php">Home</a></li>
            <li><a href="">Analysis</a>
                <div class="analysis-sub-menu">
                    <ul>
                        <li><a href="gradeSheetAnalysis.php">Grade Sheet Analysis</a></li>
                        <li><a href="semesterWiseCloPloAnalysis.php">Semester wise CLO/PLO Analysis</a></li>
                    </ul>
                </div>
            </li>
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

    <form method="post">
        <div style="display:flex;justify-content:space-evenly;">

            <select style="width:200px;margin-left:0px;" name="courseID" class="select">
                <option disabled selected>Course</option>
                <option value="CSC101">CSC101</option>
                <option value="CSC303">CSC303</option>
                <option value="MIS430">MIS430</option>
            </select>

            <select style="width:200px;margin-left:0px;" name="sectionNum" class="select">
                <option disabled selected>Section</option>
                <option value="1">Section-1</option>
                <option value="2">Section-2</option>
                <option value="3">Section-3</option>
            </select>

            <select style="width:200px;margin-left:0px;" name="semester" class="select">
                <option disabled selected>Semester</option>
                <option value="spring">spring</option>
                <option value="summer">summer</option>
                <option value="autumn">autumn</option>
            </select>

            <select style="width:200px;margin-left:0px;" name="year" class="select">
                <option disabled selected>year</option>
                <option value="2020">2020</option>
                <option value="2021">2021</option>
                <option value="2022">2022</option>
            </select>
        </div>

        <input style="margin-top:25px;" type="submit" value="Submit" name="submit" class="select">
    </form>

    <?php
    if (isset($_POST['submit'])) {

        session_start();
        $year = $_POST['year'];
        $semester = $_POST['semester'];
        $sectionNum = $_POST['sectionNum'];
        $courseID = $_POST['courseID'];

        //Getting section ID from database
        $result = mysqli_query($con, "SELECT sec.sectionID AS sectionID
                  FROM section_t AS sec
                  WHERE sec.sectionNum='$sectionNum' AND sec.courseID='$courseID' 
                  AND sec.semester='$semester' AND sec.year='$year'");
        $row = mysqli_fetch_assoc($result);
        $_SESSION['sectionID'] = $row['sectionID'];

        header('location:createCoourseOutline.php');
    }
    ?>


</body>

</html>