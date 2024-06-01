<!DOCTYPE html>
<html>
<head>
    <style>
        body {
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
        /* Responsive styling */
        @media only screen and (max-width: 600px) {
            #reader {
                width: 100%;
                height: auto;
            }
            .input-area {
                flex-direction: column;
            }
        }
    </style>
    <script src="https://raw.githack.com/mebjas/html5-qrcode/master/minified/html5-qrcode.min.js"></script>
</head>
<body>
    <div id="reader" style="width:300px;height:300px"></div>
    <div class="input-area">
        <input type="text" id="codeInput" placeholder="Enter 4-digit number">
        <button onclick="checkCode()">Submit</button>
    </div>
    <p id="status"></p>

    <script>
        function onScanSuccess(decodedText, decodedResult) {
            // Handle on success condition with the decoded text or result.
            console.log(`Scan result: ${decodedText}`, decodedResult);
            document.getElementById('codeInput').value = decodedText;
        }

        var html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", { fps: 10, qrbox: 250 });
        html5QrcodeScanner.render(onScanSuccess);

        function checkCode() {
            var scannedCode = document.getElementById('codeInput').value;
            var teacherCode = '1234'; // Replace with the actual code given by the teacher

            if (scannedCode === teacherCode) {
                document.getElementById('status').textContent = 'Your attendance is registered!';
            } else {
                document.getElementById('status').textContent = 'Incorrect code. Please try again.';
            }
        }
    </script>
</body>
</html>
