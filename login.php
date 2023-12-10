<?php

session_start();

$host = '127.0.0.1';
$dbName = 'php-inscription';
$port = 8889;
$username = 'root';
$password = 'root';

$pdo = new PDO("mysql:host={$host};dbname={$dbName};port={$port}", $username, $password);

$errors = [];

if (!empty($_POST)) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $statement = $pdo->prepare('SELECT * FROM users WHERE email = :email');
    $statement->bindValue(':email', $email);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        header('location: login-success.php');
    } else {
        $errors[] = 'Identifiant invalide';
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Comment créer un formulaire de connexion en PHP</title>
</head>

<body>
    <h1>Connexion</h1>

    <?php foreach ($errors as $error) : ?>
        <p style="background-color: lightcoral"><?= $error ?></p>
    <?php endforeach ?>

    <form method="POST">
        <label for="email">Email</label>
        <input type="email" name="email" value="<?php if ($_POST && !empty($errors)) echo $_POST['email'] ?>" required>
        <label for="password">Password</label>
        <input type="password" name="password" required>
        <input type="submit" value="Se connecter !">
    </form>
</body>

</html>