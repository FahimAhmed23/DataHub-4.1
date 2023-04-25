<?php
include 'connect.php';
session_start();
$stdId = $_SESSION['ID'];

$query = "SELECT * FROM student_grade WHERE studentID = '$stdId';";

$data = $con->query($query);

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
else{
    echo "No Result Found";
}

$con->close();
?>