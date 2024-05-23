<?php

if(isset($_POST['login']))
{
	//start of try block

	try{

		//checking empty fields
		if(empty($_POST['username'])){
			throw new Exception("Username is required!");
			
		}
		if(empty($_POST['password'])){
			throw new Exception("Password is required!");
			
		}
		//establishing connection with db and things
		include ('connect.php');
		
		//checking login info into database
		$row=0;
		$stmt = $conn->prepare("SELECT * FROM admininfo WHERE username=? AND password=? AND type=?");
		$stmt->bind_param("sss", $_POST['username'], $_POST['password'], $_POST['type']);
		$stmt->execute();
		$result = $stmt->get_result();

		$row = $result->num_rows;

		if($row>0 && $_POST["type"] == 'teacher'){
			session_start();
			$_SESSION['name']="oasis";
			header('location: teacher/index.php');
		}

		else if($row>0 &&  $_POST["type"] == 'student'){
			session_start();
			$_SESSION['name']="oasis";
			header('location: student/index.php');
		}

		else if($row>0 && $_POST["type"] == 'admin'){
			session_start();
			$_SESSION['name']="oasis";
			header('location: admin/index.php');
		}

		else{
			throw new Exception("Username,Password or Role is wrong, try again!");
			
			header('location: login.php');
		}
	}

	//end of try block
	catch(Exception $e){
		$error_msg=$e->getMessage();
	}
	//end of try-catch
}

?>


<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" type="text/css" href="css/main.css">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
   
  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
   
  <link rel="stylesheet" href="styles.css" >
   
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


	
</head>

<body>

	<center>

<header>

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

</header>



<?php
//printing error message
if(isset($error_msg))
{
	echo $error_msg;
}
?>
<div class="body">
        <div class="continer">
            <div class="card"  id="card">
                <div class="iner">
                    <div class="div1">
                        <h2>LOGIN</h2>
                        <form method="post">
                            
                            <input type="text" name="username"  class="input" id="input1" placeholder="your username" />
                            
                            <input type="password" name="password"  class="input" id="input1" placeholder="password" />
                            
                            
			<div class="form-group" class="radio">
			<label for="input1" class="">Role</label>
			
			  
			    <input type="radio" name="type" id="optionsRadios1" value="student" checked> Student
			  
			    <input type="radio" name="type" id="optionsRadios1" value="teacher"> Teacher
			  
			 
			    <input type="radio" name="type" id="optionsRadios1" value="admin"> Admin
			  
			
			</div>
                         
                            <button type="submit" class="submit-btn" name="login" >Submit</button>
                            
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

</center>
</body>
</html>