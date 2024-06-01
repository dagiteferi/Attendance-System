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
</html>
