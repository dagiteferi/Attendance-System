<?php
session_start(); // Start the session

// Check if the name and ID are set in the session
if (isset($_SESSION['name']) && isset($_SESSION['id']) && isset($_SESSION['courseName'])) {
  echo "Name: " . $_SESSION['name'] . "<br>";
  echo "ID: " . $_SESSION['id'] . "<br>";
  echo "courseName:" . $_SESSION['courseName'];
} else {
  echo "No session data found.";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>QR- Scanner</title>
  <meta charset="UTF-8">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<style>
  .body {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
    background-color: #f4f4f4;
    font-family: Arial, sans-serif;
  }

  #reader {
    display: block;
    margin: 10px auto;
    width: 80vw;
    height: 80vw;
  }

  .input-area {
    display: flex;
    justify-content: center;
    gap: 10px;
  }

  #codeInput {
    flex-grow: 1;
  }

  button {
    background-color: #48dbfb;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

  @media only screen and (max-width: 600px) {
    .reader {
      width: 100vw;
      height: 1000vw;
    }

    .input-area {
      flex-direction: column;
      width: 100vw;
      height: 1000vw;
    }
  }

  @media only screen and (max-width: 667px) {
    .reader {
      width: 100vw;
      height: 1000vw;
    }
  }
</style>
<script src="https://raw.githack.com/mebjas/html5-qrcode/master/minified/html5-qrcode.min.js"></script>
</head>

<body class="body">
  <div class="reader">
    <div id="reader" style="width:300px;height:300px"></div>
    <div class="input-area">
      <input type="text" id="teacherCodeInput" placeholder="Enter 4-digit number given by teacher" onpaste="return false;">
      <button class="buttons" onclick="startScanning()">Start Scanning</button>
      <input type="text" id="codeInput" placeholder="Enter 4-digit number" onpaste="return false;" style="display: none;">
      <button class="buttons" onclick="checkCode()" style="display: none;">Submit</button>
    </div>
    <p id="status"></p>
  </div>

  <script>
    var studentId = "<?php echo $_SESSION['id']; ?>";
    var studentName = "<?php echo $_SESSION['name']; ?>";
    var courseName = "<?php echo $_SESSION['courseName']; ?>";
  </script>

  <script>
    var teacherCode; // Declare teacherCode as a global variable
    var html5QrcodeScanner = new Html5QrcodeScanner("reader", {
      fps: 10,
      qrbox: 250
    });


    function onScanSuccess(decodedText, decodedResult) {
      // Handle on success condition with the decoded text or result.
      console.log(`Scan result: ${decodedText}`, decodedResult);

      // Extract the 4-digit number and the timestamp from the decoded text
      var parts = decodedText.split(' ');
      var scannedCode = parts[1]; // Assuming the 4-digit number is the second part of the decoded text
      var timestamp = new Date(parts[2]); // Assuming the timestamp is the third part of the decoded text

      // Check if more than 10 minutes have passed
      var now = new Date();
      var difference = now.getTime() - timestamp.getTime(); // Difference in milliseconds
      if (difference > 10 * 60 * 1000) { // More than 10 minutes
        document.getElementById('status').textContent = 'Invalid QR code. Please try again.';
        return;
      }

      if (scannedCode === teacherCode) {
        // Register the attendance

        // Clear everything
        document.body.innerHTML = "";

        // Create a new paragraph element
        var p = document.createElement("p");

        // Set the text of the paragraph element
        p.textContent = 'Your attendance is registered!';

        // Add the paragraph element to the body
        document.body.appendChild(p);

        // Send the data to the server
        $.ajax({
          url: './register_attendance.php', // Adjust the path if necessary
          type: 'post',
          data: {
            studentId: studentId,
            courseName: courseName
          },
          success: function(response) {
            console.log(response); // Log the response (optional)
            // You can also display a success message to the user here
          },
          error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown); // Log any errors (optional)
            // Display an error message to the user if needed
          }
        });
      } else {
        document.getElementById('status').textContent = 'Incorrect code. Please try again.';
      }
      html5QrcodeScanner.clear();
    }


    function registerAttendance(course_id) {
      console.log('registerAttendance called with studentId: ' + studentId + ', course_id: ' + course_id);
      var xhr = new XMLHttpRequest();

      // Configure it: GET-request for the URL /register_attendance.php
      xhr.open('GET', 'register_attendance.php?studentId=' + studentId + '&courseId=' + course_id, true);

      // Send the request over the network
      xhr.send();

      // This will be called after the response is received
      xhr.onload = function() {
        if (xhr.status != 200) { // analyze HTTP response status
          alert(`Error ${xhr.status}: ${xhr.statusText}`); // e.g. 404: Not Found
        } else { // show the result
          alert(`Attendance registered: ${xhr.response}`);
        }
      };

      xhr.onerror = function() {
        alert("Request failed");
      };
    }





    function startScanning() {

      teacherCode = document.getElementById('teacherCodeInput').value;
      // Check if the teacher code is a 4-digit number
      var regex = /^\d{4}$/;
      if (!regex.test(teacherCode)) {
        alert('Please enter a valid 4-digit teacher code.');
        return;
      }

      html5QrcodeScanner.render(onScanSuccess);
    }


    // This function is called when a QR code is scanned
    function onQRCodeScanned(data) {

      // Get the student ID from the session variable
      var studentId = "<?php echo $_SESSION['id']; ?>";
      var courseName = "<?php echo $_SESSION['courseName']; ?>";

      // Send the data to the server
      $.ajax({
        url: './register-attendance.php', // Adjust this path if necessary
        type: 'post',
        data: {
          studentId: studentId,
          courseName: courseName
        },
        success: function(response) {
          console.log(response);
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.log(textStatus, errorThrown);
        }
      });
    }
  </script>
</body>

</html>