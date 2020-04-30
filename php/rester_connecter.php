<?php

/**Page effectuant
 * la création des cookies pour l'user
 * afin qu'il reste connecté
 */
//?On se connecte à la base de données :
try {
    $bdd = new PDO('mysql:host=localhost;dbname=espace_membre;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
$pseudo = $_GET['pseudo'];
setcookie('pseudo', $pseudo, time() + 365 * 24 * 3600);
$req = $bdd->prepare('SELECT id, mdp FROM membres WHERE pseudo = :pseudo');
$req->execute(array(
    'pseudo' => $pseudo
));
$donnees = $req->fetch();
setcookie('mdp', $donnees['mdp'], time() + 365 * 24 * 3600);
header('location:page_acceuil_html.php');
