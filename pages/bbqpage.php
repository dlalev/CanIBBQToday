<?php
// Start or resume the session
session_start();

// Check if the 'location' session variable is set
if (isset($_SESSION['location'])) {
    $location = $_SESSION['location'];
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
    </div>
</body>
</html>
