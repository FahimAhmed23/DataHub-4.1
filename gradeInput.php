<?php
include 'dataEntryToDatabase.php';

$objDataEntry = new dataEntry();

if (isset($_POST['assesment-submit'])) {
    $return_msg = $objDataEntry->add_assesment($_POST);
} elseif (isset($_POST['marks-submit'])) {
    $return_msg = $objDataEntry->add_marks($_POST);
} elseif (isset($_POST['grade-submit'])) {
    $return_msg = $objDataEntry->add_grade($_POST);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Entry</title>
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
                            <p class="option-text">Assesment Details : </p>
                        </td>
                        <td><input type="text" name="details_submit" class="submit-details"></td>
                    </tr>
                    <tr>
                        <td>
                            <p class="option-text">Assesment Marks : </p>
                        </td>
                        <td><input type="text" name="marks_submit" class="submit-details"></td>
                    </tr>
                    <tr>
                        <td>
                            <p class="option-text">Difficulty Level : </p>
                        </td>
                        <td><input type="text" name="level_submit" class="submit-details"></td>
                    </tr>
                    <tr>
                        <td>
                            <p class="option-text">Exam ID : </p>
                        </td>
                        <td><input type="text" name="exam_id_submit" class="submit-details"></td>
                    </tr>
                    <tr>
                        <td>
                            <p class="option-text">Course ID : </p>
                        </td>
                        <td><input type="text" name="course_id_submit" class="submit-details"></td>
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
        <form action="" method="post">
            <table class="assesment-options">
                <tbody>
                    <tr>
                        <td>
                            <p class="option-text">Marks Details : </p>
                        </td>
                        <td><input type="text" name="marks_details" class="submit-details"></td>
                    </tr>
                    <tr>
                        <td>
                            <p class="option-text">Marks Number : </p>
                        </td>
                        <td><input type="text" name="marks_number" class="submit-details"></td>
                    </tr>
                    <tr>
                        <td>
                            <p class="option-text">Marks Obtained : </p>
                        </td>
                        <td><input type="text" name="marks_obtained" class="submit-details"></td>
                    </tr>
                    <tr>
                        <td>
                            <p class="option-text">Registration ID : </p>
                        </td>
                        <td><input type="text" name="marks_regi_id" class="submit-details"></td>
                    </tr>
                    <tr>
                        <td>
                            <p class="option-text">Exam ID : </p>
                        </td>
                        <td><input type="text" name="marks_exam_id" class="submit-details"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="submit-btn-wrapper-2">
                            <input type="submit" name="marks-submit" value="Submit" class="submit-btn-2">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
    <div>
        <form action="" method="post">
            <table class="grade-options">
                <tbody>
                    <tr>
                        <td>
                            <p class="option-text">Registration ID : </p>
                        </td>
                        <td><input type="text" name="grade_regi_id" class="submit-details"></td>
                    </tr>
                    <tr>
                        <td>
                            <p class="option-text">Total Marks : </p>
                        </td>
                        <td><input type="text" name="total_marks" class="submit-details"></td>
                    </tr>
                    <tr>
                        <td>
                            <p class="option-text">Grade Point : </p>
                        </td>
                        <td><input type="text" name="grade_point" class="submit-details"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="submit-btn-wrapper-3">
                            <input type="submit" name="grade-submit" value="Submit" class="submit-btn-3">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>

</body>

</html>