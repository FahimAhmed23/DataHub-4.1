<?php
session_start();
$haId = $_SESSION['ID'];
/* $usertype = $_SESSION['userType']; */
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript"></script>
    <title>Higher Authority Dashboard</title>
    <link rel="stylesheet" href="commonHaStyle.css">
    <style>
        .curve-chart {
            height: 400px;
            width: 800px;
            margin-left: 275px;
            margin-top: 15px;
            margin-bottom: 15px;
        }

        .select-program-comp {
            margin-left: 500px;
            margin-top: 10px;
            height: 42px;
            width: 150px;
            background-color: #032947;
            color: white;
            font-weight: bolder;
            border-radius: 4px;
        }

        .select-id-comp {
            margin-left: 50px;
            margin-top: 10px;
            height: 42px;
            width: 150px;
            background-color: #032947;
            color: white;
            font-weight: bolder;
            border-radius: 4px;
        }

        .submitComp {
            margin-left: 10px;
            margin-top: 10px;
            height: 42px;
            width: 150px;
            background-color: #032947;
            color: white;
            font-weight: bolder;
            border-radius: 4px;
        }

        .viewComp {
            margin-left: 50px;
            margin-top: 10px;
            height: 42px;
            width: 150px;
            background-color: #032947;
            color: white;
            font-weight: bolder;
            border-radius: 4px;
        }
    </style>
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
    <div style="margin-left: 400px; margin-top: 5px;">
        <form action="" method="POST">
            <select style="margin-left:10px;" name="programID" class="select-program-comp">
                <option disabled selected>Program</option>
                <option value="13">BSc in CSC</option>
                <option value="9">BSc in EEE</option>
            </select>
            <select style="margin-left:10px;" name="year" class="select-id-comp">
                <option disabled selected>Year</option>
                <option value="2020">2020</option>
                <option value="2021">2021</option>
                <option value="2022">2022</option>
            </select>
            <input type="submit" name="submit" value="Submit" class="submitComp" />
        </form>
    </div>
    <div style="margin-left: 524px; margin-top: 5px;">
        <button class="viewComp" onclick="view()">View</button>
    </div>
    <div class="row3" style="display:flex;">
        <div id="Spring" style="margin-left: 10px; height: 400px; width:400px;"></div>
        <div id="Summer" style="margin-left: 10px; height: 400px; width:400px;"></div>
        <div id="Autumn" style="margin-left: 10px; height: 400px; width:400px;"></div>
    </div>

    <?php
    include 'connect.php';

    if (isset($_POST['submit'])) {
        $year = $_POST['year'];
        $programID = $_POST['programID'];
    }
    ?>

    <script>
        function view() {

            <?php

            $sql = "SELECT plo.ploNum AS ploNum, 
              AVG((ans.markObtained/q.markPerQuestion)*100) AS percent
              FROM section_t AS sec, plo_t AS plo, answer_t AS ans, question_t AS q, 
              registration_t AS r, co_t AS co, student_t AS s
              WHERE r.sectionID=sec.sectionID AND r.registrationID=ans.registrationID 
              AND ans.examID=q.examID
              AND ans.answerNum=q.questionNum AND q.coNum=co.coNum 
              AND q.courseID=co.courseID AND co.ploID=plo.ploID 
              AND sec.year='$year' AND r.studentID=s.studentID AND s.programID='$programID' AND sec.semester='spring'
              GROUP BY plo.ploNum
              ORDER BY plo.ploNum";
            $result = mysqli_query($con, $sql);
            ?>

            google.charts.load('current', {
                'packages': ['bar']
            });
            google.charts.setOnLoadCallback(drawAutumnChart);
            google.charts.setOnLoadCallback(drawSummerChart);
            google.charts.setOnLoadCallback(drawSpringChart);

                 function drawAutumnChart() {
                var data = google.visualization.arrayToDataTable([
                    ['PLO', 'Achieved', 'Expected'],

                    <?php
                    while ($data = mysqli_fetch_array($result)) {
                        $ploNum = "PLO" . $data['ploNum'];
                        $percent = $data['percent'];
                    ?>['<?php echo $ploNum; ?>', <?php echo $percent; ?>, <?php echo '70'; ?>],
                    <?php
                    }
                    ?>
                ]);

                var options = {
                    chart: {
                        title: 'Semester Wise PLO Achievement for Program (Autumn)',
                    },
                    bars: 'vertical' // Required for Material Bar Charts.
                };

                var chart = new google.charts.Bar(document.getElementById('Autumn'));
                chart.draw(data, google.charts.Bar.convertOptions(options));
                 }   


            <?php
            $sql1 = "SELECT plo.ploNum AS ploNum, 
              AVG((ans.markObtained/q.markPerQuestion)*100) AS percent
              FROM section_t AS sec, plo_t AS plo, answer_t AS ans, question_t AS q, 
              registration_t AS r, co_t AS co, student_t AS s
              WHERE r.sectionID=sec.sectionID AND r.registrationID=ans.registrationID 
              AND ans.examID=q.examID
              AND ans.answerNum=q.questionNum AND q.coNum=co.coNum 
              AND q.courseID=co.courseID AND co.ploID=plo.ploID 
              AND sec.year='$year' AND r.studentID=s.studentID AND s.   programID='$programID' AND sec.semester='summer'
              GROUP BY plo.ploNum
              ORDER BY plo.ploNum";
            $result1 = mysqli_query($con, $sql1);
            ?>

                function drawSummerChart() {
                var data = google.visualization.arrayToDataTable([
                    ['PLO', 'Achieved', 'Expected'],

                    <?php
                    while ($data = mysqli_fetch_array($result1)) {
                        $ploNum = "PLO" . $data['ploNum'];
                        $percent = $data['percent'];
                    ?>['<?php echo $ploNum; ?>', <?php echo $percent; ?>, <?php echo '70'; ?>],
                    <?php
                    }
                    ?>
                ]);

                var options = {
                    chart: {
                        title: 'Semester Wise PLO Achievement for Program (Summer)',
                    },
                    bars: 'vertical' // Required for Material Bar Charts.
                };

                var chart = new google.charts.Bar(document.getElementById('Summer'));

                chart.draw(data, google.charts.Bar.convertOptions(options));
                }
            <?php
            $sql2 = "SELECT plo.ploNum AS ploNum, 
              AVG((ans.markObtained/q.markPerQuestion)*100) AS percent
              FROM section_t AS sec, plo_t AS plo, answer_t AS ans, question_t AS q, 
              registration_t AS r, co_t AS co, student_t AS s
              WHERE r.sectionID=sec.sectionID AND r.registrationID=ans.registrationID 
              AND ans.examID=q.examID
              AND ans.answerNum=q.questionNum AND q.coNum=co.coNum 
              AND q.courseID=co.courseID AND co.ploID=plo.ploID 
              AND sec.year='$year' AND r.studentID=s.studentID AND s.programID='$programID' AND sec.semester='autumn'
              GROUP BY plo.ploNum
              ORDER BY plo.ploNum";
            $result2 = mysqli_query($con, $sql2);
            ?>

                function drawSpringChart() {
                var data = google.visualization.arrayToDataTable([
                    ['PLO', 'Achieved', 'Expected'],

                    <?php
                    while ($data = mysqli_fetch_array($result2)) {
                        $ploNum = "PLO" . $data['ploNum'];
                        $percent = $data['percent'];
                    ?>['<?php echo $ploNum; ?>', <?php echo $percent; ?>, <?php echo '70'; ?>],
                    <?php
                    }
                    ?>
                ]);

                var options = {
                    chart: {
                        title: 'Semester Wise PLO Achievement for Program (Spring)',
                    },
                    bars: 'vertical' // Required for Material Bar Charts.
                };

                var chart = new google.charts.Bar(document.getElementById('Spring'));
                chart.draw(data, google.charts.Bar.convertOptions(options));
                }

        }
    </script>
</body>

</html>