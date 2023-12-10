<?php

session_start();

?>

<p>Connexion réussi</p>
<p>Bonjour <?= $_SESSION['user']['email'] ?></p>

<?php

if (!empty($_SESSION['user'])) {
    echo 'vous êtes bien connecté';
}

?>

<a href="logout.php">déconnexion</a>