<!doctype html>
<html>
<head>
    <meta charset="uft-8">
    <title>Reservering geslaagd</title>
    <link type="text/css" rel="stylesheet" href="main.css">
</head>
<body>

<!--navigation bar-->
<nav class="navigation-bar">
    <img class="logo" src="/Reserverings_Systeem_Amy/TCR_logo.jpg">
    <ul>
        <li><a class="active" href="index.html">Home</a></li>
        <li><a href="http://localhost/Reserverings_Systeem_Amy/client/index.php">Afspraak maken</a></li>
        <li><a href="contact.html">Contact</a></li>
        <li><a href="login.php">Login</a></li>
    </ul>
</nav>

<h3>Bedankt voor je reservering!</h3>
<?php


echo "<html>";
echo "<p>Jouw reservering</p>";
echo $_POST["name"];
echo $_POST["tel"];
echo $_POST["date"];
echo $_POST["time"]

?>

</body>
</html>
