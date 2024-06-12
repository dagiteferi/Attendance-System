<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px 0px #000;
            width: 500px;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-container input[type="text"],
        .form-container input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .form-container button {
            width: 100%;
            padding: 10px;
            background-color: #48dbfb;
            color: #fff;
            border: none;
            border-radius: 5px;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
</head>

<body>
    <div class="form-container">
        <h2>QR Code Generator</h2>
        <input type="text" id="courseName" placeholder="Enter Course Name">
        <input type="text" id="randomNumber" placeholder="Enter 4-digit Number" onpaste="return false;">
        <button onclick="generateQRCode()">Generate QR Code</button>
        <div id="qrcode"></div>
        <button id="zoomButton" style="display: none;" onclick="zoomQRCode()">Zoom</button>
    </div>
    <script type="text/javascript">
        var win; // Declare the window variable globally
        function generateQRCode() {
            // Get the current date and time
            var now = new Date();
            var utc = now.getTime() + (now.getTimezoneOffset() * 60000);
            var ethiopiaTime = new Date(utc + (3600000 * 3)); // Ethiopia is 3 hours ahead of UTC

            // Format the date and time
            var datetime = ethiopiaTime.toISOString();

            // Get course name and random number
            var courseName = document.getElementById('courseName').value;
            var randomNumber = document.getElementById('randomNumber').value;

            // Data to be encoded
            var data = courseName + ' ' + randomNumber + ' ' + datetime;

            // Clear the previous QR code
            document.getElementById('qrcode').innerHTML = "";

            // Generate the QR code
            var qrcode = new QRCode(document.getElementById("qrcode"), {
                text: data,
                width: 128,
                height: 128
            });

            // Show the zoom button
            document.getElementById('zoomButton').style.display = 'block';

            // Make the QR code and random number valid for a limited time
            setTimeout(function() {
                document.getElementById('qrcode').innerHTML = "";
                document.getElementById('zoomButton').style.display = 'none';
                if (win) win.close(); // Close the zoomed QR code window
            }, 600000); // QR code and random number are valid for 1 minute

            // Store course name in a session variable
            $.ajax({
                url: './set_course_name.php',
                type: 'post',
                data: {
                    courseName: courseName
                },
                success: function(response) {
                    console.log(response);
                }
            });
        }


        function zoomQRCode() {
            // Open the QR code in a new tab
            var dataUrl = document.querySelector('#qrcode canvas').toDataURL();
            win = window.open();
            win.document.write('<style>body {display: flex; justify-content: center; align-items: center; height: 100vh;}</style><img src="' + dataUrl + '" style="width: 30%; height: auto;"/>');

            // Set a timer to close the new tab after 1 minute
            win.setTimeout(function() {
                win.close();
            }, 600000); // 60000 milliseconds = 1 minute
        }
    </script>

</body>

</html>