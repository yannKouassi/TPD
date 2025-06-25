<?php
require_once '../includes/db.php';
require_once '../classes/User.php';

$user = new User($_POST['name'], $_POST['email']);
echo $user->save($db) ? 'OK' : 'Erreur';
