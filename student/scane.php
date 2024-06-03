

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Your existing head content here -->
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
            width: 80vw; /* Adjust as needed */
            height: 80vw; /* Adjust as needed */
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
            }
        }
        @media only screen and (max-width: 667px) {
            .reader {
                width: 100vw;
                height: 1000vw;
            }}
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
      var teacherCode; // Declare teacherCode as a global variable
      var html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", { fps: 10, qrbox: 250 });

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
          document.getElementById('status').textContent = 'Your attendance is registered!';
        } else {
          document.getElementById('status').textContent = 'Incorrect code. Please try again.';
        }

        // Stop scanning
        html5QrcodeScanner.clear();
      }

      function startScanning() {
        teacherCode = document.getElementById('teacherCodeInput').value;
        html5QrcodeScanner.render(onScanSuccess);
      }
    </script>
  </body>
  <!-- 10 min restrection -->

  <?php
// Connect to the database
// $servername = "localhost";
// $username = "username";
// $password = "password";
// $dbname = "myDB";

// $conn = new mysqli($servername, $username, $password, $dbname);

// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

// Get the scanned code and student ID from the POST request
// $scannedCode = $_POST['scannedCode'];
// $studentId = $_POST['studentId']; // Replace with actual student ID

// Get the current time
// $currentTime = time();

// Get the time of the last successful scan for this student
// $sql = "SELECT last_scan FROM Attendance WHERE student_id = ?";
// $stmt = $conn->prepare($sql);
// $stmt->bind_param("i", $studentId);
// $stmt->execute();
// $result = $stmt->get_result();
// $row = $result->fetch_assoc();
// $lastScan = $row['last_scan'];

// Check if 10 minutes have passed since the last successful scan
// if ($currentTime - $lastScan >= 600) {
    // If so, register the attendance and update the last scan time
//     $sql = "UPDATE Attendance SET last_scan = ? WHERE student_id = ?";
//     $stmt = $conn->prepare($sql);
//     $stmt->bind_param("ii", $currentTime, $studentId);
//     if ($stmt->execute()) {
//         echo "Your attendance is registered!";
//     } else {
//         echo "Error: " . $sql . "<br>" . $conn->error;
//     }
// } else {
//     echo "You can only scan once every 10 minutes. Please try again later.";
// }

// $conn->close();
// ?>


</html>
