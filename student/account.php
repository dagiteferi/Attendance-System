<?php
ob_start();
session_start();

//checking if the session is valid
if($_SESSION['name']!='oasis')
{
  header('location: ../login.php');
}

include('connect.php');

try{
  //checking form data and empty fields
  if(isset($_POST['done'])){
    if (empty($_POST['name'])) {
      throw new Exception("Name cannot be empty");
    }
    if (empty($_POST['dept'])) {
      throw new Exception("Department cannot be empty");
    }
    if(empty($_POST['batch'])) {
      throw new Exception("Batch cannot be empty");
    }
    if(empty($_POST['email'])) {
      throw new Exception("Email cannot be empty");
    }

    //initializing the student id
    $sid = $_POST['id'];

    //updating students information to database table "students"
    $stmt = $conn->prepare("update students set st_name=?, st_dept=?, st_batch=?, st_sem=?, st_email=? where st_id=?");
    $stmt->bind_param("ssssss", $_POST['name'], $_POST['dept'], $_POST['batch'], $_POST['semester'], $_POST['email'], $sid);
    $stmt->execute();
    $stmt->close();

    $success_msg = 'Updated  successfully';
  }
}
catch(Exception $e){
  $error_msg =$e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">

<!-- head started -->
<head>
<title>Online Attendance Management System 1.0</title>
<meta charset="UTF-8">
  
  <link rel="stylesheet" type="text/css" href="../css/main.css">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
   
  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
   
  <link rel="stylesheet" href="styles.css" >
   
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


</head>
<!-- head ended -->


<!-- body started -->
<body>

<!-- Menus started-->
<header>

  <h1>Online Attendance Management System 1.0</h1>
  <div class="navbar">
  <a href="index.php">Home</a>
  <a href="students.php">Students</a>
  <a href="report.php">My Report</a>
  <a href="account.php">My Account</a>
  <a href="../logout.php">Logout</a>

</div>

</header>
<!-- Menus ended -->

<!-- Content, Tables, Forms, Texts, Images started -->
<center>

<form method="post" action="" class="form-horizontal col-md-6 col-md-offset-3">
    <div class="form-group">
        <label for="input1" class="col-sm-3 control-label">Registration No.</label>
        <div class="col-sm-7">
            <input type="text" name="sr_id"  class="form-control" id="input1" placeholder="enter your reg. no. to continue" />
        </div>
    </div>
    <input type="submit" class="btn btn-primary col-md-3 col-md-offset-7" value="Go!" name="sr_btn" />
</form>

<?php
if(isset($_POST['sr_btn'])){
  echo "Form is submitted.<br>";
  echo "sr_id: " . $_POST['sr_id'] . "<br>";
}
?>


<?php

if(isset($_POST['sr_btn'])){

  //initializing student ID from form data
  $sr_id = $_POST['sr_id'];

  $i=0;

  //searching students information respected to the particular ID
  $all_query = $conn->query("select * from students where students.st_id='$sr_id'");
  while ($data = $all_query->fetch_assoc()) {
    $i++;
    ?>
<form action="" method="post" class="form-horizontal col-md-6 col-md-offset-3">
   <table class="table table-striped">
  
          <tr>
            <td>Registration No.:</td>
            <td><?php echo $data['st_id']; ?></td>
          </tr>

          <tr>
              <td>Student's Name:</td>
              <td><input type="text" name="name" value="<?php echo $data['st_name']; ?>"></input></td>
          </tr>

          <tr>
              <td>Department:</td>
              <td><input type="text" name="dept" value="<?php echo $data['st_dept']; ?>"></input></td>
          </tr>

          <tr>
              <td>Batch:</td>
              <td><input type="text" name="batch" value="<?php echo $data['st_batch']; ?>"></input></td>
          </tr>
          
          <tr>
              <td>Semester:</td>
              <td><input type="text" name="semester" value="<?php echo $data['st_sem']; ?>"></input></td>
          </tr>

          <tr>
              <td>Email:</td>
              <td><input type="text" name="email" value="<?php echo $data['st_email']; ?>"></input></td>
          </tr>
          <input type="hidden" name="id" value="<?php echo $sr_id; ?>">
          
          <tr><td></td></tr>
          <tr>
                <td></td>
                <td><input type="submit" class="btn btn-primary col-md-3 col-md-offset-7" value="Update" name="done" /></td>
                
          </tr>

    </table>
</form>
<?php 
   } 
     }  
     ?>
 </div>

</div>

</center>
<!-- Contents, Tables, Forms, Images ended -->

</body>
<!-- Menus ended -->

</html>
