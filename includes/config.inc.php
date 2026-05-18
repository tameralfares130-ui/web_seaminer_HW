<?php

$db_host = "sql102.infinityfree.com";
$db_name = "if0_41876671_saq";
$db_user = "if0_41876671";
$db_pass = "hMyXD73wD4";

try {
    $pdo = new PDO(
        "mysql:host=$db_host;dbname=$db_name;charset=utf8mb4",
        $db_user,
        $db_pass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

function h($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, "UTF-8");
}
function db() {
    global $pdo;
    return $pdo;
}
// Login helper functions for old page files
function is_logged_in() {
    return isset($_SESSION["user"]);
}

function current_user() {
    return $_SESSION["user"] ?? null;
}

function redirect_to($page) {
    header("Location: index.php?page=" . $page);
    exit;
}
// Require login helper for protected actions/pages
function require_login() {
    if (!isset($_SESSION["user"])) {
        header("Location: index.php?page=login");
        exit;
    }
}
?>