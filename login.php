<?php

$invalid=0;

if($_SERVER['REQUEST_METHOD']=='POST'){
    
    include 'connect.php';
    
    $ID=$_POST['id'];
    $password=$_POST['password'];
    $userType=$_POST['usertype'];

  if($userType=='Faculty'){
    $faculty="SELECT * from employee_t where employeeID='$ID' and password='$password'";
    $result=mysqli_query($con, $faculty);
    if($result){
        $num=mysqli_num_rows($result);
        if($num>0){
          $invalid=0;
            session_start();
            $_SESSION['ID']=$ID;
            /* $_SESSION['userType'] = $userType; */
            header('location:facultyDashboard.php');
        }
     }
  }    

  elseif($userType=='Student'){
    $std="SELECT * from student_t where studentID='$ID' and password='$password'";
    $result=mysqli_query($con,$std);
    if($result){
        $num=mysqli_num_rows($result);
        if($num>0){
          $invalid=0;
            session_start();
            $_SESSION['ID']=$ID;
            header('location:std_dashboard.php');
        }
     }
  } 
  elseif ($userType == 'HA') {
        $ha = "SELECT * from employee_t where employeeID='$ID' and password='$password'";
        $result = mysqli_query($con, $ha);
        if ($result) {
            $num = mysqli_num_rows($result);
            if ($num > 0) {
                $invalid = 0;
                session_start();
                $_SESSION['ID'] = $ID;
                header('location:haDashboard.php');
            }
        }
    }   

     else{
        $invalid=1;
    }
  }
  ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <title>Login Form</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 col-lg-4">
                <h3 class="text-center mb-4 mt-5">Login Form</h3>
                <form class="shadow p-5 rounded" action="login.php" method="POST">
                    <div class="mb-3">
                        <label for="id" class="form-label">ID:</label>
                        <input type="text" class="form-control" id="id" name="id" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="usertype" class="form-label">User Type:</label>
                        <select class="form-select" id="usertype" name="usertype" required>
                            <option value="">Select User Type</option>
                            <option value="HA">Higher Authority</option>
                            <option value="Faculty">Faculty</option>
                            <option value="Student">Student</option>
                        </select>
                    </div>
                    <button value = "Login" type="submit" class="btn btn-primary w-100">Login</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
        integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD"
        crossorigin="anonymous"></script>
</body>

</html>