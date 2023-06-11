<?php

    require "../database/connection.php";

    // Check if the registration form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the username and password from the form
        $username = $_POST["username"];
        $password = $_POST["password"];
        $lastName = $_POST["lastName"];
        $firstName = $_POST["firstName"];
        $address = $_POST["address"];
        $contactNo = $_POST["contact"];

        // Prepare and execute the SQL statement to insert the user data into the database
        $stmt = $conn->prepare("INSERT INTO users (username, password, lastName, firstName, address, contact) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $username, $password, $lastName, $firstName, $address, $contactNo);
        $stmt->execute();

        // Check if the user was successfully registered
        if ($stmt->affected_rows === 1) {
            $message = "User registered successfully.";
            header("Location: welcome.php");
        } else {
            $message = "Error registering user.";
        }

        // Close the prepared statement
        $stmt->close();
    }

    // Close the database connection
    $conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div class="regcontainer">
        <?php if (isset($message)): ?>
            <div class="success-message"><?php echo $message; ?></div>
        <?php endif; ?>
        <h2>User Registration</h2>
        <form method="POST" action="registration.php">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>
            <label for="firstName">First Name:</label>
            <input type="text" id="firstName" name="firstName" required><br><br>
            <label for="lastName">Last Name:</label>
            <input type="text" id="lastName" name="lastName" required><br><br>
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required><br><br>
            <label for="contact">Contact:</label>
            <input type="text" id="contact" name="contact" required><br><br>
            <input type="submit" value="Register">
        </form>
        <!-- <a href="/index.html"><button>Back</button></a> -->
    </div>
</body>
</html>
