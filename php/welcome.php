<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div class="navContainer">
        <div class="navLogo">
            <img src="../resources/img/travel-bus-logo-template.jpg" alt="bus-logo">
        </div>
        <div id="navLinks">
            <ul>
                <li>Home</li>
                <li>Booking</li>
                <li>Bus</li>
                <li>About Us</li>
                <li>Contact</li>
            </ul>
        </div>
        <div id="navUser">
            <p><span><?php echo $_SESSION['firstName']; ?></span></p>
        </div>
    </div>
    <h1>Hello there!!!</h1>
</body>
</html>