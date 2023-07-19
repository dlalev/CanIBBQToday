<?php
// Start or resume the session
session_start();

// Check if the 'location' session variable is set
if (isset($_SESSION['location'])) {
    $location = $_SESSION['location'];

    // API URL with the location from the session
    $apiUrl = 'https://api.weatherapi.com/v1/current.json?key=da275f0c39794899a8e104805231907&q=' . urlencode($location) . '&aqi=no';

    // Fetch the API response using file_get_contents()
    $apiResponse = file_get_contents($apiUrl);

    // Decode the JSON response to an associative array
    $weatherData = json_decode($apiResponse, true);

    // Check if the API request was successful
    if (isset($weatherData['current'])) {
        // Extract weather information
        $isDay = $weatherData['current']['is_day'];
        $temperature = $weatherData['current']['temp_c'];
        $humidity = $weatherData['current']['humidity'];
        $windSpeed = $weatherData['current']['wind_kph'];

        // Initialize the message variable
        $message = '';

        // Switch-case statement for temperature conditions
        switch (true) {
            case ($temperature < 13):
                $message .= "It's more like a hot chocolate kind of weather...";
                $backgroundImage = "cold_weather.jpg";
                break;
            case ($temperature >= 14 && $temperature <= 17):
                $message .= "Kinda cold but if you're enthusiastic... BBQ is always a good idea.";
                $backgroundImage = "custom.png";
                break;
            case ($temperature >= 18 && $temperature <= 20):
                $message .= "Chilly but why not?";
                $backgroundImage = "custom.png";
                break;
            case ($temperature >= 21 && $temperature <= 27):
                $message .= "Looks kinda good.";
                $backgroundImage = "custom.png";
                break;
            case ($temperature >= 28 && $temperature <= 30):
                $message .= "Bring cold beer and light the BBQ.";
                $backgroundImage = "custom.png";
                break;
            case ($temperature >= 31 && $temperature <= 33):
                $message .= "Light it up and bring more sunscreen.";
                $backgroundImage = "custom.png";
                break;
            default:
                $message .= "Too hot to handle. BBQ at your own risk.";
                $backgroundImage = "custom.png";
        }

        // Add message based on humidity using a ternary operator
        $message .= ($humidity > 70) ? " Too humid." : "";

        // Switch-case statement for wind speed conditions
        switch (true) {
            case ($windSpeed >= 0 && $windSpeed <= 10):
                $message .= " Perfect.";
                break;
            case ($windSpeed >= 11 && $windSpeed <= 20):
                $message .= " Wind is not gonna ruin your BBQ.";
                break;
            case ($windSpeed >= 21 && $windSpeed <= 30):
                $message .= " Strong enough to have the meat packaging fly around.";
                break;
            default:
                $message .= " Burgers are gonna flip themselves. No need to flip them.";
        }

        // Switch-case statement for daytime and nighttime background image
        switch ($isDay) {
            case 0:
                $backgroundImage = "custom.png";
                break;
            case 1:
            default:
                // For daytime, background image already set in the temperature switch-case.
        }
    } else {
        // If the API request failed or data is not available
        $message = "Weather information not available.";
        $backgroundImage = "custom.png";
    }
} else {
    // If the location variable is not set, redirect back to index.php
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Location</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Custom background based on $backgroundImage variable */
        body {
            background: url('<?php echo $backgroundImage; ?>') center center no-repeat;
            background-size: cover;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Your Location: <?php echo htmlspecialchars($location); ?></h1>
        <h2>Weather Information</h2>
        <p><?php echo htmlspecialchars($message); ?></p>
    </div>
</body>
</html>
