


<?php 
  
  include('connect.php');


 ?>


<!DOCTYPE html>
<html lang="en">
<head>
<title>Online Attendance Management System 1.0</title>
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

<div class="content">
    <div class="row">

    <form method="post" class="form-horizontal col-md-6 col-md-offset-3">
    <h3>Recover your password</h3>

      <div class="form-group">

          <label for="input1" class="col-sm-2 control-label">Email</label>
          <div class="col-sm-10">
            <input type="email" name="email"  class="form-control" id="input" placeholder="your email" />
          </div>
      </div>

      <input type="submit" class="submit-btn" value="Go" name="reset" />
    </form>

      <br>

      <?php

          if(isset($_POST['reset'])){

          $test = $_POST['email'];
          $row = 0;
          $query = mysql_query("select password from admininfo where email = '$test'");
          $row = mysql_num_rows($query);

          if($row == 0){
?>
      <div  class="content"><p>Email is not associated with any account. Contact OAMS 1.0</p></div>

<?php
          }

          else{

            $query = mysql_query("select password from admininfo where email = '$test'");
            $i =0;
            while($dat = mysql_fetch_array($query)){
                $i++;
?>
  <strong>
  <p style="text-align: left;">Hi there!<br>You requested for a password recovery. You may <a href="index.php">Login here</a> and enter this key as your password to login. Recovery key: <mark><?php echo $dat['password']; ?></mark><br>Regards,<br>Online Attendance Management System 1.0</p></strong>
<?php
      }
          }
  }


       ?>

  </div>

</div>

</center>

</body>
</html>
