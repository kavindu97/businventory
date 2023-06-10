<?php
// Database connection details
$hostname = "localhost";
$username = "root";
$password = "";
$database = "bus";

// Create a connection to the MySQL database
$conn = new mysqli($hostname, $username, $password, $database);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the login form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the username and password from the form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Prepare and execute the SQL statement to check if the user exists
    $stmt = $conn->prepare("SELECT username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a row was returned
    if ($result->num_rows == 1) {
        // Fetch the row
        $row = $result->fetch_assoc();

        // Verify the password
        if ($password === $row["password"]) {
            // Password is correct, redirect to a protected page
            header("Location: welcome.php");
            exit();
        } else {
            // Invalid password
            echo "Invalid password";
        }
    } else {
        // User does not exist
        echo "User does not exist";
    }

    // Close the prepared statement and result set
    $stmt->close();
    $result->close();
}

// Close the database connection
$conn->close();
?>
