<?php

session_start();

require_once "../includes/config.inc.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../index.php?page=login");
    exit;
}

$family_name = trim($_POST["family_name"] ?? "");
$surname     = trim($_POST["surname"] ?? "");
$login_name  = trim($_POST["login_name"] ?? "");
$email       = trim($_POST["email"] ?? "");
$password    = $_POST["password"] ?? "";

if (
    $family_name === "" ||
    $surname === "" ||
    $login_name === "" ||
    !filter_var($email, FILTER_VALIDATE_EMAIL) ||
    strlen($password) < 6
) {
    $_SESSION["error"] = "Please fill every registration field correctly. Password must be at least 6 characters.";
    header("Location: ../index.php?page=login");
    exit;
}

try {
    $check = $pdo->prepare("SELECT id FROM users WHERE login_name = ? OR email = ?");
    $check->execute([$login_name, $email]);

    if ($check->fetch()) {
        $_SESSION["error"] = "This login name or email is already registered.";
        header("Location: ../index.php?page=login");
        exit;
    }

    $stmt = $pdo->prepare(
        "INSERT INTO users (family_name, surname, login_name, email, password_hash)
         VALUES (?, ?, ?, ?, ?)"
    );

    $stmt->execute([
        $family_name,
        $surname,
        $login_name,
        $email,
        password_hash($password, PASSWORD_DEFAULT)
    ]);

    $_SESSION["success"] = "Registration successful. Please log in manually.";
    header("Location: ../index.php?page=login");
    exit;

} catch (PDOException $e) {
    $_SESSION["error"] = "Registration failed: " . $e->getMessage();
    header("Location: ../index.php?page=login");
    exit;
}
?>