<?php

// Error reporting is intentionally quiet for end users. Errors are still
// tracked by PHP's normal error log (see the php.ini `error_log` /
// `log_errors` settings on the server) even with display_errors off.
error_reporting(E_ALL);
ini_set('display_errors', 0);

// Database connection parameters.
//
// Credentials are read from environment variables rather than being
// hardcoded here. Required variables:
//   DB_HOST  - MySQL host (optional, defaults to "localhost")
//   DB_USER  - MySQL username (required)
//   DB_PASS  - MySQL password (required)
//   DB_NAME  - MySQL database name (optional, defaults to "restaurant_db")
//
// See db.example.php for a documented template and instructions on how to
// set these variables locally.
$hostname = getenv('DB_HOST') ?: 'localhost';
$username = getenv('DB_USER');
$password = getenv('DB_PASS');
$database = getenv('DB_NAME') ?: 'restaurant_db';

if (!$username || !$password) {
    die('Database credentials not configured. Set DB_USER and DB_PASS environment variables.');
}

// Create connection
$conn = new mysqli($hostname, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    // Do not leak internal connection details (host, driver messages, etc.)
    // to the client. The real error is available in $conn->connect_error
    // for server-side logging if a logging framework is added later.
    die('A server error occurred. Please try again later.');
}
//echo "Connected to the database successfully";
//echo "<br>";
//echo "<br>";

$tableName = "items_table";

// Fetch data from the table
$sql = "SELECT * FROM $tableName";
$result = $conn->query($sql);

$menu_items = array();

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        // Add each row as an item to the menu_items array
        $menu_items[] = $row;
    }
} else {
    echo "0 results";
}

// For test purposes
//var_dump($menu_items);

// Close connection
$conn->close();

?>