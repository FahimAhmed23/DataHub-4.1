<?php
include 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrollment Stats</title>
    <link rel="stylesheet" href="commonHaStyle.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
<div class="ha-menu-bar">
        <ul>
            <li><a href="haDashboard.php">Home</a></li>
            <li><a href="">Student Analysis</a>
                <div class="analysis-sub-menu">
                    <ul>
                        <li><a href="haGradeSheet.php">Grade Sheet</a></li>
                        <li><a href="haStudentWiseCoPlo.php">Student PLO</a></li>
                    </ul>
                </div>
            </li>
            <li><a href="">PLO Comparison</a>
                <div class="analysis-sub-menu">
                    <ul>
                        <li><a href="haCourseWiseComparison.php">Course Wise</a></li>
                        <li><a href="haProgramWiseComparison.php">Program Wise</a></li>
                        <li><a href="haSchoolWiseComparison.php">School Wise</a></li>
                    </ul>
                </div>
            </li>
            <li><a href="backlogData.php">Backlog Data</a></li>
            <li><a href="enrollmentStats.php">Enrollment Stats</a></li>
            <li><a href="">GPA Analysis</a>
                <div class="analysis-sub-menu">
                    <ul>
                        <li><a href="haschoolDeptProgramGpa.php">School/Dept Wise</a></li>
                        <li><a href="haCourseGpa.php">Course Wise</a></li>
                        <li><a href="haInstructorGpa.php">Instructor Wise</a></li>
                    </ul>
                </div>
            </li>
            <button class="log-out" type="button"><a href="logout.php" target="_self">Log Out</a></button>
        </ul>
    </div>
    <div class="search-option-part">
        <div>
            <form method="POST">
                <select name="year" id="year" class="select-year">
                    <option disabled selected>Year</option>
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                </select>
                <input type="submit" name="submit" value="Submit" class="submit-button">
            </form>
        </div>
        <div class="option-button">
            <button onclick="schoolWiseEnrollment()" class="school-wise">School-wise</button>
            <button class="department-wise" onclick="departmentWiseEnrollment()">Department-wise</button>
            <button onclick="programWiseEnrollment()" class="program-wise">Program-wise</button>
        </div>
        <div id="chart-container-enrollment" class="chart-enrollment">
            <canvas id="myChart-enrollment"></canvas>
        </div>
    </div>

    <?php
    if (isset($_POST['submit'])) {
        session_start();
        $_SESSION["year"] = $_POST['year'];
    }
    ?>

    <script>
        function departmentWiseEnrollment() {
            <?php
            $year = $_SESSION['year'];
            $deptEnrollmentStats = "SELECT d.departmentName AS department, COUNT(s.studentID) AS studentNumber
            FROM department_t AS d, student_t AS s
            WHERE s.enrollmentYear=$year AND d.departmentID=s.departmentID
            GROUP BY s.departmentID";

            $result = mysqli_query($con, $deptEnrollmentStats);
            $studentNumbers = array();
            $departments = array();
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    array_push($studentNumbers, $row["studentNumber"]);
                    array_push($departments, $row["department"]);
                }
            }
            ?>

            let parseStudentNumbers = <?php echo json_encode($studentNumbers); ?>;
            let parsedepartments = <?php echo json_encode($departments); ?>;
            let total = parseStudentNumbers.reduce((acc, cur) => acc + Number(cur), 0);
            parseStudentNumbers = parseStudentNumbers.map(item => ((Number(item) * 100) / total).toFixed(2));
            document.getElementById("chart-container-enrollment").style.backgroundColor = "#fff";

            const ctxDepartment = document.getElementById('myChart-enrollment');
            new Chart(ctxDepartment, {
                type: 'pie',
                data: {
                    labels: parsedepartments,
                    datasets: [{
                        label: '% ',
                        data: parseStudentNumbers,
                        borderWidth: 1
                    }]
                },
            });


        }

        function schoolWiseEnrollment() {

            <?php
            $year = $_SESSION['year'];
            $schoolEnrollmentStats = "SELECT sch.schoolName as schoolName, COUNT(s.studentID) AS number
            FROM student_t AS s INNER JOIN department_t AS d 
            ON s.departmentID=d.departmentID
            INNER JOIN school_t AS sch
            ON d.schoolID=sch.schoolID
            WHERE s.enrollmentYear='$year' AND d.departmentID=s.departmentID
            GROUP BY sch.schoolName";

            $result2 = mysqli_query($con, $schoolEnrollmentStats);
            $schoolName = array();
            $number = array();
            if (mysqli_num_rows($result2) > 0) {
                while ($row = mysqli_fetch_assoc($result2)) {
                    array_push($schoolName, $row["schoolName"]);
                    array_push($number, $row["number"]);
                }
            }

            ?>
            let parseSchoolName = <?php echo json_encode($schoolName); ?>;
            let parseNumber = <?php echo json_encode($number); ?>;

            console.log(parseSchoolName)
            console.log(parseNumber)

            let total = parseNumber.reduce((acc, cur) => acc + Number(cur), 0);
            parseNumber = parseNumber.map(item => ((Number(item) * 100) / total).toFixed(2));


            document.getElementById("chart-container-enrollment").style.backgroundColor = "#fff";

            const ctxSchool = document.getElementById('myChart-enrollment');
            new Chart(ctxSchool, {
                type: 'pie',
                data: {
                    labels: parseSchoolName,
                    datasets: [{
                        label: '% ',
                        data: parseNumber,
                        borderWidth: 1
                    }]
                },
            });
        }

        function programWiseEnrollment() {
            <?php
            $year = $_SESSION['year'];
            $programEnrollmentStats =
                "SELECT p.programName AS programName,COUNT(s.studentID) AS number
            FROM student_t AS s,program_t AS p
            WHERE s.enrollmentYear='$year' AND s.programID=p.programID
            GROUP BY p.programName";

            $result = mysqli_query($con, $programEnrollmentStats);
            $programName = array();
            $pNumber = array();
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    array_push($programName, $row["programName"]);
                    array_push($pNumber, $row["number"]);
                }
            }
            ?>

            let parseNumber = <?php echo json_encode($pNumber); ?>;
            let parseProgramName = <?php echo json_encode($programName); ?>;
            let total = parseNumber.reduce((acc, cur) => acc + Number(cur), 0);
            parseNumber = parseNumber.map(item => ((Number(item) * 100) / total).toFixed(2));
            document.getElementById("chart-container-enrollment").style.backgroundColor = "#fff";

            const ctxProgram = document.getElementById('myChart-enrollment');
            new Chart(ctxProgram, {
                type: 'pie',
                data: {
                    labels: parseProgramName,
                    datasets: [{
                        label: '% ',
                        data: parseNumber,
                        borderWidth: 1
                    }]
                },
            });
        }
    </script>
</body>

</html>