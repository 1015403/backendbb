<?php

session_start();

/** @var $db */
require_once "backend.php";
$login = false;

if (isset($_POST['submit'])) {
    $user = mysqli_real_escape_string($db, $_POST['user']);
    $password = $_POST['password'];

    //Get record from DB based on first name
    $query = "SELECT * FROM `users` WHERE 1='$user'";
    $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
            $login = true;
        } else {
            $error = "Onjuiste inloggegevens";
        }
    } else {
        $error = "Onjuiste inloggegevens";
    }
    if (!isset($error)) {
        $_SESSION['login'] = $user;
    }
}


if (isset($_SESSION['login'])) {
    header("Location: read.php ");
    exit;
}


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
<h1>Login</h1>

<?php if (isset($error)) { ?>
    <p><?= $error; ?></p>
<?php } ?>

<form method="post" action="<?= $_SERVER['REQUEST_URI']; ?>">
    <div>
        <label for="user">Gebruikersnaam:</label>
        <input id="user" type="text" name="user"/>
    </div>
    <div>
        <label for="password">Wachtwoord:</label>
        <input id="password" type="password" name="password"/>
    </div>
    <div>
        <input type="submit" name="submit" value="Login"/>
    </div>
</form>
</body>
</html>
