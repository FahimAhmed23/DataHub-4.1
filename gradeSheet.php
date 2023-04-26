<?php
include 'connect.php';
$courseID = $_REQUEST["courseID"];
$section = $_REQUEST["section"];

$grade = "SELECT studentID,section,courseID,totalMarks,obtainedGrade
          FROM student_grade
          WHERE section='$section' AND courseID='$courseID'";

$data = $con->query($grade);

if ($data->num_rows > 0){
    echo "<table>
    <tr>
    <th>StudentID</th>
    <th>Section</th>
    <th>Course ID</th>
    <th>Grade</th>
    <th>CO percantage</th>";
    while ($row = $data->fetch_assoc()){
        echo "<tr><td>".$row["studentID"]."</td><td>".$row["section"]."</td><td>".$row["courseID"]."</td><td>".$row["obtainedGrade"]."</td><td>".$row["totalMarks"]."</td></tr>";
    }
    echo "</table>";
}
else {
    echo "No Result Found";
}
$con->close();
