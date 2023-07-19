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
        // Extract the weather information
        $temperature = $weatherData['current']['temp_c'];
        $condition = $weatherData['current']['condition']['text'];
    } else {
        // If the API request failed, set default values for temperature and condition
        $temperature = 'N/A';
        $condition = 'Unknown';
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
</head>
<body>
    <div class="container">
        <h1>Your Location: <?php echo htmlspecialchars($location); ?></h1>
        <h2>Weather Information</h2>
        <p>Temperature: <?php echo htmlspecialchars($temperature); ?>°C</p>
        <p>Condition: <?php echo htmlspecialchars($condition); ?></p>
    </div>
</body>
</html>
