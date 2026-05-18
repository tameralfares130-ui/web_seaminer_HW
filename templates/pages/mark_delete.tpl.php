<?php
$pdo = db();

$id = (int)($_GET["id"] ?? 0);

if ($id) {
    $stmt = $pdo->prepare("DELETE FROM marks WHERE id = ?");
    $stmt->execute([$id]);

    $_SESSION["success"] = "Mark deleted successfully.";
} else {
    $_SESSION["error"] = "Missing mark ID.";
}

header("Location: index.php?page=table");
exit;
?>