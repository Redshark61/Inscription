<?php

/**Programme permettant
 * au user de s'inscrire
 */

//?On se connecte à la base de données :
try {
    $bdd = new PDO('mysql:host=localhost;dbname=espace_membre;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

//?On sélectionne toutes les valeurs :
$req = $bdd->query('SELECT * FROM membres');

//?On récupère les valeurs de la page d'inscription :
$pseudo = $_POST['pseudo'];
$mdp = $_POST['password'];
$mdp_confirm = $_POST['password_confirme'];
$mail = $_POST['mail'];

//*SI les deux mots de passe sont identique on lance le programme :
if ($mdp == $mdp_confirm) {

    //*Si le mail est une forme de mail valide (exemple@exemle.com) :
    if (preg_match('#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#', $mail)) {

        //*On récupère toute les lignes de la base de donnée :
        while ($donnees = $req->fetch()) {

            //*Si un élément 'pseudo' de la bdd est indentique à celui rentré par l'utilisateur
            //* on renvoie sur la page de connexion avec un message d'erreur:
            if ($pseudo == $donnees['pseudo']) {
                $req->closeCursor();
                header('location:http://localhost/page_inscription/inscription_html.php?pseudo_probleme=true');
                exit(); // ! Ne pas oublier d' EXIT !
            }
        }

        //*Si le pseudo n'est pas présent (donc tout va bien):

        //!On ferme la bdd
        $req->closeCursor();

        //*On chiffre le mot de passe :
        $mdp_hache = password_hash($_POST['password'], PASSWORD_DEFAULT);

        //*Et on insère toutes les données dans la bdd
        $req = $bdd->prepare('INSERT INTO membres(pseudo, mdp, email, date_inscription) VALUES(:pseudo,:mdp_hache, :mail, CURDATE() )');
        $req->execute(array(
            'pseudo' => $pseudo,
            'mdp_hache' => $mdp_hache,
            'mail' => $mail
        ));

        //*Si il a coché la case 'rester connecté' on passe par le programme
        //*rester_connecter.php pour pouvoir créer un cookie sauvegarde ses données
        if (isset($_POST['checkbox'])) {
            $req->closeCursor();
            header('location:rester_connecter.php?pseudo=' . $pseudo);
            exit(); // ! Ne pas oublier d' EXIT !
        }

        //*Si le mail n'est pas valide : 
    } else {
        $req->closeCursor();
        header('location:http://localhost/page_inscription/inscription_html.php?mail_probleme=true');
        exit(); // ! Ne pas oublier d' EXIT !
    }

    //*Si les deux mots de passe ne sont PAS identique
    //*on renvoi sur la page de connexion avec un message d'erreur :
} else {
    $req->closeCursor();
    header('location:http://localhost/page_inscription/inscription_html.php?mdp_probleme=true');
    exit(); // ! Ne pas oublier d' EXIT !
}
