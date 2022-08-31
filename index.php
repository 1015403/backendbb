<?php
    if (isset($_POST['date'])) {
    require "../backend.php";
    if ($_RSV->save(
        $_POST['date'], $_POST['time'], $_POST['name'], $_POST['tel'])) {
        echo "<div class='ok'>".$_RSV->succes."Reservering opgeslagen.</div>";
    } else { echo "<div class='err'>".$_RSV->error."Reservering is mislukt. Probeer opnieuw.</div>"; }
    }
?>


<!doctype html>
<html>
    <head>
    <meta charset="uft-8">
        <title>Techniek College Rotterdam</title>
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

      <h2>BPV-Gesprekken</h2>
      <h3>Bert Rommelse</h3>

      <h1>Stagegesprekken</h1>
      <p>Via onderstaand formulier kan je een afspraak maken voor een stagegesprek.</p>

    <form id="resForm" method="post" target="_self">
        <label for="res_name">Naam</label>
        <input type="text" required name="name" value=""/>
        <label for="res_tel">Studentcode</label>
        <input type="text" required name="tel" value=""/>
        <label>Datum</label>
        <input type="date" required id="res_date" name="date" value="<?=date("Y-m-d")?>">
        <label>Tijd</label>
        <input type="time" required id="res_time" name="time" value="<?=date("h:i:sa")?>">
        <input type="submit" value="Submit"/>
      </form>
    </body>
</html>

