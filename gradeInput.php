<?php
include 'dataEntryToDatabase.php';
include './utils/gradeConvertion.php';

$objDataEntry = new dataEntry();
$message = "";



if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['assesment-submit'])) {
    $message = "";
    $formData = array(
        "std_id" => $_POST['std_id'],
        "ed_year" => $_POST['ed_year'],
        "ed_sem" => "'" . $_POST['ed_sem'] . "'",
        "enroll_course" => "'" . $_POST['enroll_course'] . "'",
        "enroll_section" => $_POST['enroll_section'],
        "obtained_marks" => $_POST['obtained_marks']
    );

    $flag = true;

    foreach ($formData as $key => $value) {
        if (!$value) {
            $flag = false;
        }
    }
    $_POST = array();

    if ($flag) {
        // std_section_input
        $col = array("sectionNum", "studentID", "semester", "courseID", "enrolledYear");
        $value = array($formData["enroll_section"], $formData["std_id"], $formData["ed_sem"], $formData["enroll_course"], $formData["ed_year"]);
        $columns = implode(", ", $col);
        $values = implode(", ", $value);
        $res1 = $objDataEntry->insertIntoTable("std_section", $columns, $values);

        // grade_table_input
        $gradeValue = gradeConvertion($formData["obtained_marks"]);
        $gradeTableCol = array("studentID", "section", "courseID", "totalMarks", "obtainedGrade");
        $values = array($formData["std_id"], $formData["enroll_section"], $formData["enroll_course"], $formData["obtained_marks"], $gradeValue);
        $gradeColumns = implode(", ", $gradeTableCol);
        $gradeValues = implode(", ", $values);
        $res2 = $objDataEntry->insertIntoTable("student_grade", $gradeColumns, $gradeValues);

        // backlog_table_input
        session_start();
        $facultyId = $_SESSION['ID'];
        $milliseconds = floor(microtime(true) * 1000);
        /* $seconds = $milliseconds/1000;
        $date = date("d/m/y H:i:s", $seconds); */
        $backlogCol = array("studentID", "educationalYear", "educationalSemester", "enrolledCourse", "enrolledSection", "obtainedGrade", "userID", "timeStamp");
        $backlogVal = array($formData["std_id"], $formData["ed_year"], $formData["ed_sem"], $formData["enroll_course"], $formData["enroll_section"], $gradeValue, $facultyId, $milliseconds);
        $backlogCols = implode(", ", $backlogCol);
        $backlogVals = implode(", ", $backlogVal);
        $res3 = $objDataEntry->insertIntoTable("backlog_data", $backlogCols, $backlogVals);

        if ($res1 && $res2 && $res3) {
            $message = "data entry successfull!";
            $objDataEntry->closeMYSQL();
            header('location:gradeInput.php');
        }
    } else {
        echo "All field required";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grade Input</title>
    <link rel="stylesheet" href="gradeInput.css">
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

    <div class="data-entry-table">
        <form action="" method="post">
            <table class="assesment-options">
                <tbody>
                    <tr>
                        <td>
                            <p class="option-text">Student ID : </p>
                        </td>
                        <td><input type="text" name="std_id" class="submit-details"></td>
                    </tr>
                    <tr>
                        <td>
                            <p class="option-text">Educational year : </p>
                        </td>
                        <td><input type="text" name="ed_year" class="submit-details"></td>
                    </tr>
                    <tr>
                        <td>
                            <p class="option-text">Educational semester : </p>
                        </td>
                        <td><input type="text" name="ed_sem" class="submit-details"></td>
                    </tr>
                    <tr>
                        <td>
                            <p class="option-text">Enroll course : </p>
                        </td>
                        <td><input type="text" name="enroll_course" class="submit-details"></td>
                    </tr>
                    <tr>
                        <td>
                            <p class="option-text">Enrolled section : </p>
                        </td>
                        <td><input type="text" name="enroll_section" class="submit-details"></td>
                    </tr>
                    <tr>
                        <td>
                            <p class="option-text">Total Marks: </p>
                        </td>
                        <td><input type="text" name="obtained_marks" class="submit-details"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="submit-btn-wrapper">
                            <input type="submit" name="assesment-submit" value="Submit" class="submit-btn">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
    <div>
        <?php echo $message ?>
    </div>

    <div class="csv-file">
        <form action="" method="POST" enctype="multipart/form-data">
            <p class="text-csv">Upload CSV File: <input type="file" name="file" class="upload-btn"></p>
            <p><input type="submit" name="submit" value="import" class="import-btn"></p>
        </form>
    </div>
    <?php
    include 'connect.php';

    if (isset($_POST["submit"])) {
        if ($_FILES['file']['name']) {
            $filename = explode('.', $_FILES['file']['name']);
            if ($filename[1] == 'csv') {
                $handle = fopen($_FILES['file']['tmp_name'], "r");
                while ($data = fgetcsv($handle)) {
                    $studentId = mysqli_real_escape_string($con, $data[0]);
                    $year = mysqli_real_escape_string($con, $data[1]);
                    $semester = mysqli_real_escape_string($con, $data[2]);
                    $courseId = mysqli_real_escape_string($con, $data[3]);
                    $section = mysqli_real_escape_string($con, $data[4]);
                    $totalMarks = mysqli_real_escape_string($con, $data[5]);
                    // std_section input
                    $query1 = "INSERT INTO std_section(sectionNum, studentID, semester, courseID, enrolledYear) VALUES($section, $studentId, '$semester', '$courseId', $year)";
                    mysqli_query($con, $query1);

                    //grade_table input
                    $gradeConvert = gradeConvertion($totalMarks);
                    $query2 = "INSERT INTO student_grade(studentID, section, courseID, totalMarks, obtainedGrade) VALUES($studentId, $section, '$courseId', $totalMarks, $gradeConvert)";
                    mysqli_query($con, $query2);
                    // backlog_table input
                    session_start();
                    $facultyID = $_SESSION['ID'];
                    $millisecond = floor(microtime(true) * 1000);
                    $query3 = "INSERT INTO backlog_data(studentID, educationalYear, educationalSemester, enrolledCourse, enrolledSection, obtainedGrade, userID, timeStamp) VALUES($studentId, $year, '$semester', '$courseId', $section, $gradeConvert, $facultyID, $millisecond)";
                    mysqli_query($con, $query3);
                }

                echo 'Import Done Successfully!';
                fclose($handle);
                header('location:gradeInput.php');
            }
        }
    }
    ?>

</body>

</html>