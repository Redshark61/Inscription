<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>

<body>
    <!--Page vérifiant si l'utilisateur veut rester connecter-->
    <?php
    if (!empty($_COOKIE['mdp']) && !empty($_COOKIE['pseudo'])) {
        header('location:page_acceuil_html.php');
        exit();
    }
    ?>
    <form action="reconnexion.php" method="POST">
        <input type="password" name="mdp" id="mdp" placeholder="Mot de passe">
        <input type="text" name="pseudo" id="pseudo" placeholder="Pseudo">

        <label for="checkbox">Rester connecter :</label>
        <input type="checkbox" name="checkbox" id="checkbox">
        <input type="submit" name="submit" id="submit" value="Envoyer">
    </form>
</body>

</html>