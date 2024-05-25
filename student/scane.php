<?php
if(isset($_POST['code'])){
    // Include your database connection file
    include 'db_connection.php';

    // Get the QR code data from the AJAX request
    $code = $_POST['code'];

    // TODO: Validate the QR code data

    // TODO: Extract the student's name, id, and email from the QR code data

    // TODO: Insert the attendance record into the database

    echo "Attendance registered successfully!";
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <script src="https://cdn.rawgit.com/cozmo/jsQR/1.0.1/dist/jsQR.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <video id="qr-video" autoplay playsinline></video>
    <canvas id="qr-canvas" style="display: none;"></canvas>
    <script type="text/javascript">
        var video = document.getElementById("qr-video");
        var canvasElement = document.getElementById("qr-canvas");
        var canvas = canvasElement.getContext("2d");

        function tick() {
    if (video.readyState === video.HAVE_ENOUGH_DATA) {
        canvasElement.hidden = false;

        canvasElement.height = video.videoHeight;
        canvasElement.width = video.videoWidth;
        canvas.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);
        var imageData = canvas.getImageData(0, 0, canvasElement.width, canvasElement.height);
        var code = jsQR(imageData.data, imageData.width, imageData.height);
        if (code) {
            console.log("Found QR code", code.data);
            $.ajax({
                url: window.location.href, // Current page
                type: 'post',
                data: { 'code': code.data },
                success: function(data) {
                    console.log(data);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }
    }
    requestAnimationFrame(tick);
}


        navigator.mediaDevices.getUserMedia({ video: { facingMode: "environment" } }).then(function(stream) {
            video.srcObject = stream;
            video.play();
            requestAnimationFrame(tick);
        });
    </script>
</body>
</html>
