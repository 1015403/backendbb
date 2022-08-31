<?php

session_start();
/** @var $reservations */
require_once "backend.php";

?>

<!doctype html>
<html lang="en">
<head>
    <title>Reservering overzicht</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="main.css"/>
</head>
<body id="alternative">
<div id="container">
    <h1>Reservering</h1>

    <div class="intro-links">
        <a href="create.php">Nieuwe reservering toevoegen</a>
        <a href="allReservations.php">Gemaakte reserveringen bekijken</a>
    </div>

    <section>
        <div class="">
            <?php foreach ($reservations as $reservation) { ?>
                <div class="album">
                    <div class="links">
                        <h2><?= $reservation['name']; ?></h2>
                        <a class="edit" href="edit.php?id=<?= $reservation['id']; ?>">Edit</a>
                        <a class="delete" href="delete.php?id=<?= $reservation['id'];?>">Delete</a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>
</div>
</body>
</html>
