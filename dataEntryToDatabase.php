<?php
    Class dataEntry{
        private $conn;

        public function __construct()
        {
        $HOSTNAME = 'localhost';
        $USERNAME = 'root';
        $PASSWORD = '';
        $DATABASE = 'datahub';

        $this->conn = mysqli_connect($HOSTNAME, $USERNAME, $PASSWORD, $DATABASE);

        if (!$this->conn) {
            die("Database Connection Erro!");
        }
        }

        public function add_assesment($assesmentData){
            $asses_details = $assesmentData['details_submit'];
            $asses_marks = $assesmentData['marks_submit'];
            $asses_level = $assesmentData['level_submit'];
            $asses_exam_id = $assesmentData['exam_id_submit'];
            $asses_course_id = $assesmentData['course_id_submit'];

            $asses_query = "INSERT INTO assesment_t(assesmentDetails,assesmentMarks,difficultyLevel,exaamID,courseID) VALUE('$asses_details',$asses_marks,$asses_level,$asses_exam_id,'$asses_course_id') ";

            if(mysqli_query($this->conn,$asses_query)){
                return "Info inserted";
            }
        }

        public function add_marks($marksData)
        {
            $marks_details = $marksData['marks_details'];
            $marks_number = $marksData['marks_number'];
            $marks_obtained = $marksData['marks_obtained'];
            $marks_regi_id = $marksData['marks_regi_id'];
            $marks_exam_id = $marksData['marks_exam_id'];

            $marks_query = "INSERT INTO marks_t(marksDetail,marksNum,marksObtained,registrationID,examID) VALUE('$marks_details',$marks_number,$marks_obtained,$marks_regi_id,$marks_exam_id) ";

            if (mysqli_query($this->conn, $marks_query)) {
                return "Info inserted";
            }
        }

        public function add_grade($gradeData)
        {
            $grade_regi_id = $gradeData['grade_regi_id'];
            $total_marks = $gradeData['total_marks'];
            $grade_point = $gradeData['grade_point'];

            $grade_query = "INSERT INTO student_course_performance_t(registrationID,totalMarksObtained,gradePoint) VALUE($grade_regi_id,$total_marks,$grade_point) ";

            if (mysqli_query($this->conn, $grade_query)) {
                return "Info inserted";
            }
    }
    }
?>

