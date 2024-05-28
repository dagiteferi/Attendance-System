<?php

ob_start();
session_start();

if($_SESSION['name']!='oasis')
{
  header('location: ../index.php');
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <!--for the fabicons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
    <!--for my nav bar toggler works and background Change when scrol -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../javaScript/scripts.js"></script><!--my main JavaScript File Exernal JS-->
    <!--to add a font-->  
   <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <title>Student</title>
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
        <a href="index.php">Home</a>
       <a href="report.php">My Report</a>
      <a href="account.php">My Account</a>
      <a href="../logout.php">Logout</a>
      <a href="students.php">Students</a>
      </div>
    </div>
  </nav>
  <!--home-->
  <section id="home">
    <div class="inner-width">
      <div class="content">
      <div class="front">
        
  
  <div class="front-child1">
    <h1 style = "font-size:35px">
    QR-Attendance-System
      <span class=""> Be attentive and be regular :)</span>
    </h1>
    <div class="front-child1">
    <div class="buttons">
    
    <a href="permission.php" target="_blank" >ask permission</a>
   
    
    <a href="scane.php"  target="_blank"   >scan the qr code</a>
    
    </div>
    </div>
  </div>
  
</div>
            
        </div>
      </div>
    </div> 
</section>
<!-- Menus ended -->



<!-- Content, Tables, Forms, Texts, Images started -->
<div class="row">
    <div class="content">
      <p>Be attentive and be regular :)</p>
    <img src="../img/tcr.png" height="200px" width="300px" />

  </div>

</div>


</body>

<footer>
      
      <div class="copyright">
        &copy; 2024 | Created & Designed By <a href="#home">Dagmawi Teferi</a>
      </div>
      <div class="sm">
        <a href="#/"><i class="fa fa-facebook" style="font-size:24px"></i></a>
        <a href="#/" ><i class="fa fa-instagram" style="font-size:24px"></i></a>
        <a href="#/" ><i class="fa fa-linkedin" style="font-size:24px"></i></a>
        <a href="#" ><i class="fa fa-telegram" style="font-size:24px"></i></a>
        <a href="#" ><i class="fa fa-github" style="font-size:24px"></i></a>
       </div>
     </footer>
</html>
