<?php
session_start();

if (isset($_POST['login'])) {
  function test_input($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  try {
    if (empty($_POST['username'])) {
      throw new Exception("Username is required!");
    } else {
      $name = test_input($_POST["username"]);
      if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
        throw new Exception("Only letters and white space allowed");
      }
    }

    if (empty($_POST['password'])) {
      throw new Exception("Password is required!");
    }

    include('connect.php');

    $stmt = $conn->prepare("SELECT * FROM admininfo WHERE username=? AND password=?");
    $stmt->bind_param("ss", $_POST['username'], $_POST['password']);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      $data = $result->fetch_assoc();
      $_SESSION['name'] = $data['username'];
      $type = $data['type'];

      if ($type == 'teacher') {
        header('location: teacher/index.php');
      } else if ($type == 'student') {
        $stmtStudent = $conn->prepare("SELECT st_id FROM students WHERE st_email = ?");
        $stmtStudent->bind_param("s", $data['email']);
        $stmtStudent->execute();
        $resultStudent = $stmtStudent->get_result();

        if ($resultStudent->num_rows > 0) {
          $dataStudent = $resultStudent->fetch_assoc();
          $_SESSION['id'] = $dataStudent['st_id']; // now you can access the user's ID
        } else {
          throw new Exception("Student ID not found.");
        }

        header('location: student/index.php');
      } else if ($type == 'admin') {
        header('location: admin/index.php');
      } else {
        throw new Exception("Invalid role selected!");
      }
    } else {
      throw new Exception("Username or Password is wrong, try again!");
    }
  } catch (Exception $e) {
    $error_msg = $e->getMessage();
  }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <!--for the fabicons-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!--for my nav bar toggler works and background Change when scrol -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="javaScript/scripts.js"></script><!--my main JavaScript File Exernal JS-->
  <!--to add a font-->
  <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
  <title>Login</title>
</head>

<body>





  <!-- Navbar -->
  <nav class="navbar">
    <div class="inner-width">
      <a href="index.html" class="logo"></a>
      <button class="menu-toggler">
        <span></span>
        <span></span> <!--nav bar for mobile view-->
        <span></span>
      </button>
      <div class="navbar-menu">
        <a href="index.php">Home</a>
        <a href="about.php">About</a>
        <a href="service.php">Services</a>
        <a href="contact.php">Contact</a>


      </div>
    </div>
  </nav>





  <?php
  //printing error message
  if (isset($error_msg)) {
    echo $error_msg;
  }
  ?>
  <div class="body">
    <div class="continer">
      <div class="card" id="card">
        <div class="iner">
          <div class="div1">
            <h2>LOGIN</h2>
            <form method="post">

              <input type="text" name="username" class="input" id="input1" placeholder="your username" />

              <input type="password" name="password" class="input" id="input1" placeholder="password" />


              <div class="form-group" class="radio">
                <label for="input1" class="">Role</label>


                <input type="radio" name="type" id="optionsRadios1" value="student" checked> Student

                <input type="radio" name="type" id="optionsRadios1" value="teacher"> Teacher


                <input type="radio" name="type" id="optionsRadios1" value="admin"> Admin


              </div>

              <button type="submit" class="submit-btn" name="login">Submit</button>

            </form>
            <a href="signup.php">
              <button type="button" class="btn">If you are New</button>
            </a>
            <a href="reset.php">Forgot Password</a>
          </div>
        </div>
      </div>
    </div>
  </div>


</body>

</html>