<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

require_once 'src/Utils/Database.php';
$db = Database::getInstance();

if (isset($_GET['id']) && isset($_GET['called'])) {
    $calledStatus = (int)$_GET['called'];
    $stmt = $db->prepare("UPDATE leads SET called = ? WHERE id = ?");
    $stmt->execute([$calledStatus, $_GET['id']]);

    header('Location: backoffice.php');
    exit;
}
?>