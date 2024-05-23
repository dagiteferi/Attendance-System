<?php

include('connect.php');


?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Online Attendance Management System </title>
<meta charset="UTF-8">
  
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
   
  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
   
  <link rel="stylesheet" href="styles.css" >
   
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  
  <script src="javaScript/scripts.js"></script>  
  <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
</head>
<body>



  <!-- Navbar -->
  <nav class="navbar">
    <div class="inner-width">
      <a href="#home" class="logo"></a>
      <button class="menu-toggler">
        <span></span>
        <span></span>
        <span></span>
      </button>
      <div class="navbar-menu">
        <a href="#home">Home</a>
        <a href="#about">About</a>
        
        <a href="#contact">Contact</a>
      </div>
    </div>
  </nav>


<center>

                          

  <div class="row">
    <?php
    if(isset($success_msg)) echo $success_msg;
    if(isset($error_msg)) echo $error_msg;
     ?>
    
    <div class="body">
        <div class="continer">
            <div class="card" id="card">
                <div class="div1">
                        <h2>LOGIN</h2>
                        <form method="post">
                            <input type="text" name="email"  class="input" id="input1" placeholder="your email" />
                            <input type="text" name="uname"  class="input" id="input1" placeholder="choose username" />
                            <input type="password" name="pass"  class="input" id="input1" placeholder="choose a strong password" />
                            <input type="text" name="fname"  class="input" id="input1" placeholder="your full name" />
                            <input type="text" name="phone"  class="input" id="input1" placeholder="your ID number" />
                            <label for="input1" class="col-sm-3 control-label">Role</label>
                            <input type="radio" name="type" id="optionsRadios1" value="student" checked> Student
                            <input type="radio" name="type" id="optionsRadios1" value="teacher"> Teacher
                            <button type="submit" class="submit-btn" name="signup">Submit</button>
                        </form>
                        <a href="index.php">
                            <button type="button" class="btn">Already have an account? </button>   </a>
                        
                    </div>
                </div>
            </div>
        </div>
   
</center>

</body>
</html>
