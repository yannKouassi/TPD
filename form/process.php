<?php 

try {
   $DatabaseConnection = new PDO("mysql:host=localhost;dbname=l2miage", "root", "yann1212");
   $DatabaseConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $exception) {
    die("Erreur : " . $exception->getMessage());
}

$errors = [];

if (isset($_POST['register'])) {
   
    $nom = trim($_POST['name'] ?? '');
    $prenom = trim($_POST['firstname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

   
    if (empty($nom) || empty($prenom) || empty($email) || empty($password)) {
        $errors['global'] = "Remplir tous les champs";
    }

    
    if (strlen($nom) < 2) {
        $errors['name'] = "Le nom doit contenir au moins 2 caractères.";
    }

  
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Adresse email invalide.";
    }

  
    $stmt = $DatabaseConnection->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
    $stmt->execute([':email' => $email]);
    if ($stmt->fetchColumn() > 0) {
        $errors['email_exists'] = "Cet email est déjà utilisé.";
    }

    if (empty($errors)) {
        $q = $DatabaseConnection->prepare("INSERT INTO users (name, firstname, email, password) VALUES (:name, :firstname, :email, :password)");
        $q->execute([
            ':name' => $nom, 
            ':firstname' => $prenom,
            ':email' => $email,
            ':password' => password_hash($password, PASSWORD_DEFAULT)
        ]);
        header("Location: form.php");
        exit;
    }
}


require_once 'form.php';
?>
