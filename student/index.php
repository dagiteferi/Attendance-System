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

<!-- head started -->
<head>

<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="../css/main.css">

</head>
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

<center>

<!-- Content, Tables, Forms, Texts, Images started -->
<div class="row">
    <div class="content">
      

  </div>

</div>
<!-- Contents, Tables, Forms, Images ended -->

</center>

</body>
<!-- Body ended  -->

</html>
