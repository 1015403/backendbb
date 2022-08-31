<?php
session_start();


/** @var $db */
require_once "backend.php";

$query = "SELECT * FROM reservations";
$result = mysqli_query($db, $query);

//Loop through the result to create a custom array

while ($row = mysqli_fetch_assoc($result)) {
    $reservations[]  = $row;
}

foreach ($reservations as $key => $part) {
    $sort[$key] = strtotime($part['datum']);
}
foreach ($reservations as $key => $part) {
    $sort2[$key] = strtotime($part['tijd']);
}
array_multisort($sort, SORT_ASC, $reservations);

$day = date('d');
$date = $day  . '-'.  date('m-Y') ;

foreach ($reservations as $a) {
    if($a['datum'] < $date){
        $id = $a['id'];
        $query = "DELETE FROM reservations WHERE id =". $id;
        $result = mysqli_query($db, $query);
    }
}

mysqli_close($db);
?>


<!doctype html>
<html lang="en">
<head>
    <title>Reserveringen overzicht</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="main.css"/>
</head>
<body id="alternative">
<div id="container">
    <h1>Totale reserveringen overzicht</h1>
    <p><a href="overzicht.php">Terug naar overzicht</a> </p>

    <section>
        <div class="reservations">
            <?php foreach ($reservations as $a) { ?>
                <div class="reservation" id="reservation">
                        <p>Naam: <?= $a['name'] ?></p>
                        <p>Studentnummer: <?= $a['tel']?></p>
                        <p>Datum: <?= $a['date']; ?></p>
                        <p>Tijd: <?= $a['time']; ?> </p>
                </div>
            <?php } ?>
        </div>
    </section>
</div>
</body>
</html>
