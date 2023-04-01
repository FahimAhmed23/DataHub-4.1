<?php

try {
    session_start();
    $studentId = $_SESSION["ID"] ? $_SESSION["ID"] : false;

    if($studentId == false) {
        throw new Exception("Student ID not found");
    }

    $query = "SELECT marks.marksObtained, marks.examID, assesment.assesmentMarks FROM marks_t marks, assesment_t assesment WHERE marks.examID = assesment.exaamID AND (marks.registrationID = (SELECT registrationID FROM `registration_t` WHERE studentID = $studentId))";

    $result = mysqli_query($con, $query);
    $obtainedMarks = array();
    $assesmentMark = array();
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            switch ($row["examID"]) {
                case '9':
                    $obtainedMarks["mid"] = $row["marksObtained"];
                    $assesmentMark["mid"] = $row["assesmentMarks"];
                    break;
                case '10':
                    $obtainedMarks["final"] = $row["marksObtained"];
                    $assesmentMark["final"] = $row["assesmentMarks"];
                    break;
                case '11':
                    $obtainedMarks["project"] = $row["marksObtained"];
                    $assesmentMark["project"] = $row["assesmentMarks"];
                    break;
                default:
                    break;
            }
        }
    }
    $PLO2 = ($obtainedMarks["mid"] / $assesmentMark["mid"]) * 100;
    $PLO3 = (($obtainedMarks["mid"] + $obtainedMarks["final"]) / ($assesmentMark["mid"] + $assesmentMark["final"])) * 100;
    $PLO4 = (($obtainedMarks["project"] + $obtainedMarks["final"]) / ($assesmentMark["project"] + $assesmentMark["final"])) * 100;
    $PLO6 = (($obtainedMarks["project"] + $obtainedMarks["final"]) / ($assesmentMark["project"] + $assesmentMark["final"])) * 100;
} 
catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
}
