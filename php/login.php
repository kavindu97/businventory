<?php

    // Start the session
    session_start();

    require "../database/connection.php";

    // Check if the login form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the username and password from the form
        $username = $_POST["username"];
        $password = $_POST["password"];
        echo $username."<br>";
        echo $password."<br>";

        // Prepare and execute the SQL statement to check if the user exists
        $stmt = $conn->prepare("SELECT `username`, `password`, `lastName`, `firstName`, `address`, `contact` FROM `users` WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if a row was returned
        if ($result->num_rows == 1) {
            // Fetch the row
            $row = $result->fetch_assoc();

            // Store user details in session variables
            $_SESSION['username'] = $row["username"];
            $_SESSION['password'] = $row["password"]; 
            $_SESSION['lastName'] = $row["lastName"];
            $_SESSION['firstName'] = $row["firstName"];
            $_SESSION['address'] = $row["address"];
            $_SESSION['contact'] = $row["contact"];

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
