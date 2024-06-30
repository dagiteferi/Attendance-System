<?php

include('connect.php');


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
        <a href="reset.php">Home</a>
        <a href="reset.php">About</a>
        <a href="reset.php">Services</a>

        <a href="reset.php">Contact</a>
      </div>
    </div>
  </nav>

  <center>

    <div class="body">
      <div class="continer">
        <div class="card" id="card">
          <div class="iner">
            <div class="div1">
              <h2>Recover password</h2>
              <form method="post">
                <input type="email" name="email" class="input" id="input1" placeholder="your email" required />

                <!-- <input type="submit" class="submit-btn" value="Go" name="reset" /> -->
                <button type="submit" class="submit-btn" name="reset" value="Go">Go</button>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>

    <br>
    <?php

    if (isset($_POST['reset'])) {

      $test = $_POST['email'];
      $row = 0;
      $stmt = $conn->prepare("SELECT password FROM admininfo WHERE email = ?");
      $stmt->bind_param("s", $test);
      $stmt->execute();
      $result = $stmt->get_result();

      $row = $result->num_rows;

      if ($row == 0) {
    ?>
        <div class="content">
          <p>Email is not associated with any account. Contact OAMS 1.0</p>
        </div>

        <?php
      } else {

        while ($dat = $result->fetch_assoc()) {
        ?>
          <strong>
            <p style="text-align: left;">Hi there!<br>You requested for a password recovery. You may
              <a href="index.php">Login here</a> and enter this key as your password to login. Recovery key: <mark style="background-color: #48dbfb;">
                <?php echo $dat['password']; ?></mark><br>Regards,<br>Online Attendance Management System 1.0
            </p>
          </strong>
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