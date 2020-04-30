<?php
/**Programme permettant
 * de supprimer les données du user
 * si il décide de se déconnecter manuellement
 */

//*On démarre une session :
session_start();
 
//*Pour pouvoir la vider puis la détruire :
$_SESSION = array();
session_destroy();

//*On vide les cookies, l'utilisateru sera obligé de se reconnecter manuellement
setcookie('pseudo', '');
setcookie('mdp', '');

//*On le renvoie à la page d'inscription
header('location:inscription_html.php');
exit();
