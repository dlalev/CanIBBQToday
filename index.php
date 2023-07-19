<?php
    if (isset($_POST["submit"])) {
        // Start the session and set the location value in a session variable
        session_start();
        $_SESSION["location"] = $_POST["location"];
    
        // Redirect to the location.php page
        header("Location: pages/bbqpage.php");
        exit;
    }
    else{
        displayForm();
    }

    function displayForm(){
        ?>
<!DOCTYPE html>
<html>
<head>
    <title>Can I BBQ?</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class="container">
        <h1>Get Your Location</h1>
        <form action="index.php" method="POST">
            <label for="location">Enter your location:</label>
            <input type="text" id="location" name="location" required>
            <button type="submit" name="submit" id="submit">Submit</button>
        </form>
        <br>
        <button onclick="getMyLocation()">Give My Location Automatically</button>
    </div>

    <script>
        function getMyLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;
                    const locationInput = document.getElementById("location");
                    locationInput.value = latitude + "," + longitude;
                });
            } else {
                alert("Geolocation is not supported by your browser.");
            }
        }
    </script>
</body>
</html>

<?php

    }

?>