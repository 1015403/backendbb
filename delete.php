<?php
//Require music data & image helpers to use variable in this file
/** @var $db */
require_once "DB.php";
require_once "image-helpers.php";

if (isset($_POST['submit'])) {
    // DELETE IMAGE
    // To remove the image we need to query the file name from the db.
    // Get the record from the database result
    $query = "SELECT * FROM kleding WHERE id = " . mysqli_escape_string($db, $_POST['id']);
    $result = mysqli_query($db, $query) or die ('Error: ' . $query);

    $kleding = mysqli_fetch_assoc($result);

    if (!empty($kleding['image'])) {
        deleteImageFile($kleding['image']) ;
    }

    // DELETE DATA
    // Remove the album data from the database
    $query = "DELETE FROM kleding WHERE id = " . mysqli_escape_string($db, $_POST['id']);
    mysqli_query($db, $query) or die ('Error: ' . mysqli_error($db));

    //Close connection
    mysqli_close($db);

    //Redirect to homepage after deletion & exit script
    header("Location: overzicht.php");
    exit;

} else if (isset($_GET['id'])) {
    //Retrieve the GET parameter from the 'Super global'
    $kledingId = $_GET['id'];

    //Get the record from the database result
    $query = "SELECT * FROM kleding WHERE id = " . mysqli_escape_string($db, $kledingId);
    $result = mysqli_query($db, $query) or die ('Error: ' . $query);

    if (mysqli_num_rows($result) == 1) {
        $kleding = mysqli_fetch_assoc($result);
    } else {
        // redirect when db returns no result
        header('Location: overzicht.php');
        exit;
    }
} else {
    // Id was not present in the url OR the form was not submitted

    // redirect to index.php
    header('Location: overzicht.php');
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Delete - <?= $kleding['naam'] ?></title>
</head>
<body>
<h2>Delete - <?= $kleding['naam'] ?></h2>
<form action="" method="post">
    <p>
        Weet u zeker dat u kledingstuk "<?= $kleding['naam'] ?>" wilt verwijderen?
    </p>
    <input type="hidden" name="id" value="<?= $kleding['id'] ?>"/>
    <input type="submit" name="submit" value="Verwijderen"/>
</form>
</body>
</html>