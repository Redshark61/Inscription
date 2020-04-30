<?php session_start(); ?>
<!--SIMPLE PAGE D'ACCEUIL APRES INSCRIPTION-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>page acceuil</title>
</head>

<body>
    <?php

    echo 'bravo : ' . $_COOKIE['pseudo'];
    ?>
    <form action="deconnexion.php" method="POST">
        <input type="submit" value="Déconnexion">
    </form>
</body>

</html>