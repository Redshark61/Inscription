<?php

/**Page traitant
 * la reconnexion du user
 */

//?On se connecte à la base de données :
try {
    $bdd = new PDO('mysql:host=localhost;dbname=espace_membre;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
$mdp = $_POST['mdp'];
$pseudo = $_POST['pseudo'];

//*  Récupération de l'utilisateur et de son mdp hashé
$req = $bdd->prepare('SELECT id, mdp, pseudo FROM membres WHERE pseudo = :pseudo');
$req->execute(array(
    'pseudo' => $pseudo
));

$resultat = $req->fetch();

//* On vérifie que la bdd contient le pseudo :
if (isset($resultat['pseudo'])) {
    //* Si oui, on vérifie que le mot de passe est contenu dans la bdd (après le hachage) :
    $ismdpCorrect = password_verify($mdp, $resultat['mdp']);

    //*Si le résultat n'est pas bon :
    if (!$resultat) {
        echo 'Mauvais identifiant ou mot de mdpe !';
        $req->closeCursor();

        //* Si le résultat est bon :
    } else {
        if ($ismdpCorrect) {
            session_start();

            if (isset($_POST['checkbox'])) {
                $req->closeCursor();
                header('location:rester_connecter.php?pseudo=' . $pseudo);
                exit();
            }

            $_SESSION['id'] = $resultat['id'];
            $_SESSION['pseudo'] = $pseudo;
            header('location:page_acceuil_html.php');
            exit();

            $req->closeCursor();
        } else {
            echo 'Mauvais identifiant ou mot de mdp !';
            $req->closeCursor();
        }
    }
} else {
    echo 'Mauvais mot de passe ou identifiant';
}
