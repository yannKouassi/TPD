<?php
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $name = trim($_POST['name'] ?? '');
    $firstname = trim($_POST['firstname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($name) || empty($firstname) || empty($email) || empty($password)) {
        $errors['global'] = "Veuillez remplir tous les champs.";
    }

    // Par exemple, une validation simple email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['global1'] = "L'adresse email n'est pas valide.";
    }

    // Si pas d'erreur, tu peux traiter la connexion à la BDD, insertion, etc.
    if (empty($errors)) {
        // Exemple : redirection vers une autre page ou message de succès
        header("Location: accueil.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Formulaire d'inscription</title>
    <link rel="stylesheet" href="form.css" />
</head>
<body>
    <div class="form-box">
        <form class="form" action="" method="post">
            <span class="title">Connection</span>
            <span class="subtitle" style="color:red;">
                <?php if (isset($errors['global'])) echo htmlspecialchars($errors['global']); ?>
            </span>
            <div class="form-container">
                <input type="text" class="input" placeholder="name" name="name" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>" />
                <input type="text" class="input" placeholder="surname" name="firstname" value="<?= htmlspecialchars($_POST['firstname'] ?? '') ?>" />
                <span class="subtitle" style="color:red;">
                    <?php if (isset($errors['global1'])) echo htmlspecialchars($errors['global1']); ?>
                </span>
                <input type="email" class="input" placeholder="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" />
                <input type="password" class="input" placeholder="password" name="password" />
            </div>
            <button type="submit" name="register">Inscription</button>
        </form>
        <div class="form-section">
            <p>Have an account? <a href="">Log in</a></p>
        </div>
    </div>
</body>
</html>
