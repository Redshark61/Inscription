<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>

<body>
    <!--FORMULAIRE D'INSCRIPTION-->
    <form action="connexion.php" method="POST">
        <?php
        //*Si l'URL contient une information
        if ($_GET) {
            //*On vérifie si l'info est un problème de pseudo :
            if (isset($_GET['pseudo_probleme'])) {
                echo 'Le pseudo est déjà pris<br>';
            } else {
                echo '';
            }
        }
        ?>

        <label for="pseudo">Pseudo :</label>
        <input type="text" name="pseudo" id="pseudo"><br>

        <?php
        //*Si l'URL contient une information

        if ($_GET) {
            //*On vérifie si l'info est un problème de pseudo :

            if (isset($_GET['mdp_probleme'])) {
                echo 'Veuillez re-taper votre mot de passe<br>';
            } else {
                echo '';
            }
        }

        ?>

        <label for="password">Mot de passe :</label>
        <input type="password" name="password" id="password"><br>

        <label for="password_confirme">Confirmer votre de passe :</label>
        <input type="password" name="password_confirme" id="password_confirme"><br>

        <?php
        //*Si l'URL contient une information
        if ($_GET) {
            //*On vérifie si l'info est un problème de pseudo :

            if (isset($_GET['mail_probleme'])) {
                echo 'Veuillez rentrer un mail valide<br>';
            } else {
                echo '';
            }
        }

        ?>

        <label for="mail">E-mail :</label>
        <input type="text" name="mail" id="mail"><br>
        <label for="checkbox">Rester connecter :</label>
        <input type="checkbox" name="checkbox" id="checkbox"><br>

        <input type="submit" name="valider" id="valider" value="valider">


    </form>

    <form action="reconnexion_html.php" method="POST">
        <input type="submit" name="connexion" id="connexion" value="Déjà connecté ?">
    </form>

</body>

</html>