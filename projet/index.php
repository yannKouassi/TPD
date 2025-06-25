<?php
require_once 'includes/header.php';
require_once 'includes/db.php';

$page = $_GET['page'] ?? 'index';
$allowedPages = ['index', 'dashboard'];

if (!in_array($page, $allowedPages)) {
    $page = 'index';
}


$viewFile = "views/{$page}.php";

if (file_exists($viewFile)) {
    require_once $viewFile;
} else {
    echo "La page demandée n'existe pas.";
}

require_once 'includes/footer.php';

if (extension_loaded('pdo_mysql')) {
    echo "PDO MySQL est activé.";
} else {
    echo "PDO MySQL n'est PAS activé.";
}
