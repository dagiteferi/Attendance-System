<!DOCTYPE html>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
</head>
<body>
    <div id="qrcode"></div>
    <script type="text/javascript">
        // Get the current date and time in Ethiopia
        var now = new Date();
        var utc = now.getTime() + (now.getTimezoneOffset() * 60000);
        var ethiopiaTime = new Date(utc + (3600000*3)); // Ethiopia is 3 hours ahead of UTC

        // Format the date and time
        var datetime = ethiopiaTime.toISOString();

        // Data to be encoded
        var data = 'Your Data Here ' + datetime;

        // Generate the QR code
        var qrcode = new QRCode(document.getElementById("qrcode"), {
            text: data,
            width: 128,
            height: 128
        });
    </script>
</body>
</html>
