<!DOCTYPE html>
<html>
<head>
    <!-- Your existing head content here -->
</head>
<body>
    <div id="studentView">
        <h2>Permission Request Form</h2>
        <form id="requestForm">
            <label for="reason">Reason for Absence:</label><br>
            <textarea id="reason" name="reason"></textarea><br>
            <input type="submit" value="Submit">
        </form>
    </div>

    <script>
        document.getElementById('requestForm').addEventListener('submit', function(event) {
            // Prevent the form from being submitted normally
            event.preventDefault();

            // Get the reason for absence
            var reason = document.getElementById('reason').value;

            // Send the permission request to the server
            sendPermissionRequest(reason);
        });

        function sendPermissionRequest(reason) {
            // This is a placeholder for your actual function to send the permission request to the server
            // You would typically use AJAX or the Fetch API to send the request asynchronously

            console.log('Sending permission request: ' + reason);

            // After sending the request, you could clear the form and show a confirmation message
            document.getElementById('reason').value = '';
            alert('Your permission request has been sent to your teacher.');
        }
    </script>
</body>
</html>
