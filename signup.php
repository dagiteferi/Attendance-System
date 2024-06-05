<?php

include('connect.php');

  try{
    
      if(isset($_POST['signup'])){

        if(empty($_POST['email'])){
          throw new Exception("Email cann't be empty.");
        }

        if(empty($_POST['uname'])){
           throw new Exception("Username cann't be empty.");
        }

        if(empty($_POST['pass'])){
           throw new Exception("Password cann't be empty.");
        }
        
        if(empty($_POST['fname'])){
           throw new Exception("Full name cann't be empty.");
        }
        if(empty($_POST['id'])){
           throw new Exception("id number cann't be empty.");
        }
        if(empty($_POST['type'])){
           throw new Exception("User type cann't be empty.");
        }

        $stmt = $conn->prepare("INSERT INTO admininfo (username, password, email, fname, phone, type) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $_POST['uname'], $_POST['pass'], $_POST['email'], $_POST['fname'], $_POST['phone'], $_POST['type']);

        if ($stmt->execute()) {
           // Start the session and store the student's ID and name in session variables
           session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['studentId'] = $stmt->insert_id; // The ID of the newly inserted record
            $_SESSION['studentName'] = $_POST['fname'];
            $success_msg = "Signup Successfully!";
        } else {
            throw new Exception("Error: " . $stmt->error);
        }
  
  }
}
  catch(Exception $e){
    $error_msg =$e->getMessage();
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
        <span></span>  <!--nav bar for mobile view-->
        <span></span>
      </button>
      <div class="navbar-menu">
        <a href="index.html">Home</a>
        <a href="index.html#about">About</a><!--move to home-pagee about section-->
        <a href="index.html#service">Services</a><!--move to home-pagee Services section-->
        <a href="index.html#education">Education</a><!--move to home-pagee Education section-->
        <a href="index.html#work">Works</a><!--move to home-pagee Works section-->
        <a href="index.html#contact">Contact</a><!--move to home-pagee Contact section-->
      </div>
    </div>
  </nav>


<!-- <div class="content">

  <div class="row"> -->
    <?php
    if(isset($success_msg)) echo $success_msg;
    if(isset($error_msg)) echo $error_msg;
     ?>
    
    <div class="body">
    <div class="continer">
        <div class="card" id="card">
            <div class="div1">
                <h2>REGISTER</h2>
                <form method="post" >
                   
                    <input type="text" name="email"  class="input" id="input1" placeholder="your email" required/>
                    <input type="text" name="uname"  class="input" id="input1" placeholder="choose username" />
                    
                    <input type="password" name="pass"  class="input" id="input1" placeholder="choose a strong password" />
                    <input type="text" name="fname"  class="input" id="input1" placeholder="your full name" />
                    <input type="text" name="id"  class="input" id="input1" placeholder="your id number" />
                    <div class="form-group" class="radio">
                        <label for="input1" class="">Role</label>
                        
                          
                            <input type="radio" name="type" id="optionsRadios1" value="student" checked> Student
                          
                            <input type="radio" name="type" id="optionsRadios1" value="teacher"> Teacher
                          </div>
                    <button type="submit" class="submit-btn" name="signup" >Submit</button>
                    
                </form>
                <a href="index.php">
                    <button type="button" class="btn" style="margin-top: 20px;">I've an account</button>
                </a>
                
            </div>
        </div>
    </div>
</div>


</body>
</html>
