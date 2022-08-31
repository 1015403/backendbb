<?php

session_start();

/** @var $db */
require_once "backend.php";

$query = "SELECT * FROM `reservations` ";
$result = mysqli_query($db, $query);

while ($row = mysqli_fetch_assoc($result)) {
    $reservations[] = $row;

}

//Check if Post isset, else do nothing
if (isset($_POST['submit'])) {
    /** @var $db */
    require_once "backend.php";

    //Postback with the data showed to the user, first retrieve data from 'Super global'
    $name = mysqli_escape_string($db, $_POST['name']);
    $tel = mysqli_escape_string($db, $_POST['tel']);
    $date = mysqli_escape_string($db, $_POST['date']);
    $time = mysqli_escape_string($db, $_POST['time']);


    $errors = [];
    if ($name == "") {
        $errors['name'] = 'Name cannot be empty';
    }
    if ($tel == "") {
        $errors['tel'] = 'Student-number cannot be empty';
    }
    if ($date == "") {
        $errors['date'] = 'Date cannot be empty';
    }
    if($time == ""){
        $errors['time'] = 'Time cannot be empty';
    }


        //Save the record to the database
        $query = "INSERT INTO reservations (name, tel, date, time)
                  VALUES ('$name', '$tel', '$date', '$time')";
        $result = mysqli_query($db, $query) or die('Error: ' . $query);

        if ($result) {
            header('Location: overzicht.php');
            exit;
        } else {
            $errors['db'] = 'Something went wrong in your database query: ' . mysqli_error($db);
        }

        //Close connection
        mysqli_close($db);
}

?>
<!doctype html>
<html lang="en">
<head>
    <title>Nieuwe reservering toevoegen</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="main.css"/>
</head>
<body>
<h1>Nieuwe afspraak</h1>
<?php if (isset($errors['db'])) { ?>
    <div><span class="errors"><?= $errors['db']; ?></span></div>
<?php } ?>

<!-- enctype="multipart/form-data" no characters will be converted -->
<form action="" method="post" enctype="multipart/form-data">
    <div class="data-field">
        <label for="name">Naam</label>
        <input id="name" type="text" name="naam" value="<?= isset($name) ? htmlentities($name) : '' ?>"/>
        <span class="errors"><?= isset($errors['name']) ? $errors['name'] : '' ?></span>
    </div>
    <div class="data-field">
        <label for="tel">Studentnummer</label>
        <input id="tel" type="text" name="tel" value="<?= isset($tel) ? htmlentities($tel) : '' ?>"/>
        <span class="errors"><?= isset($errors['tel']) ? $errors['tel'] : '' ?></span>
    </div>
    <div class="data-field">
        <label for="date">Datum</label>
        <select id="date" name="date" type="date">

        <?php foreach ($reservations as $a) { ?>
            <option value="<?= $a['reservations'] ?>"><?= $a['reservations'] ?></option>
        <?php } ?>

</form>
<div>
    <a href="overzicht.php">Go back to the list</a>
</div>
</body>
</html>
