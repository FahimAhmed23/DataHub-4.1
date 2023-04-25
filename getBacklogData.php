<?php
include 'connect.php';

$query = "SELECT * FROM backlog_data";

$data = $con->query($query);

if ($data->num_rows > 0){
    echo "<table>
    <tr>
    <th>Student ID</th>
    <th>Educational Year</th>
    <th>Enrolled Semester</th>
    <th>Enrolled Course</th>
    <th>Enrolled Section</th>
    <th>Obtained Grade</th>
    <th>User ID</th>
    <th>Time Stamp</th>";
    while ($row = $data->fetch_assoc()){
        echo "<tr><td>".$row["studentID"]."</td><td>".$row["educationalYear"]."</td><td>".$row["educationalSemester"]."</td><td>".$row["enrolledCourse"]."</td><td>".$row["enrolledSection"]."</td><td>".$row["obtainedGrade"]."</td><td>".$row["userID"]."</td><td>".$row["timeStamp"]."</td></tr>";
    }
    echo "</table>";
}
else{
    echo "No Result Found";
}

$con->close();
?>