<?php
$pdo = db();

$id = (int)($_GET["id"] ?? 0);

if (!$id) {
    $_SESSION["error"] = "Missing mark ID.";
    header("Location: index.php?page=table");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM marks WHERE id = ?");
$stmt->execute([$id]);
$row = $stmt->fetch();

if (!$row) {
    $_SESSION["error"] = "Mark not found.";
    header("Location: index.php?page=table");
    exit;
}

$students = $pdo->query("SELECT id, sname, class FROM students ORDER BY sname")->fetchAll();
$subjects = $pdo->query("SELECT id, sname FROM subjects ORDER BY sname")->fetchAll();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $studentid = (int)($_POST["studentid"] ?? 0);
    $subjectid = (int)($_POST["subjectid"] ?? 0);
    $mdate = $_POST["mdate"] ?? date("Y-m-d");
    $mark = (int)($_POST["mark"] ?? 0);
    $type = trim($_POST["type"] ?? "");

    if ($studentid && $subjectid && $mdate && $mark >= 1 && $mark <= 5 && $type !== "") {
        $stmt = $pdo->prepare(
            "UPDATE marks 
             SET studentid = ?, subjectid = ?, mdate = ?, mark = ?, type = ?
             WHERE id = ?"
        );

        $stmt->execute([$studentid, $subjectid, $mdate, $mark, $type, $id]);

        $_SESSION["success"] = "Mark updated successfully.";
        header("Location: index.php?page=table");
        exit;
    } else {
        $_SESSION["error"] = "Please fill every field correctly.";
    }
}
?>

<section class="panel">
    <h2>Edit Mark</h2>

    <form method="post" class="form-card">

        <label>Student
            <select name="studentid">
                <?php foreach ($students as $s): ?>
                    <option value="<?= h($s["id"]) ?>" <?= (int)$row["studentid"] === (int)$s["id"] ? "selected" : "" ?>>
                        <?= h($s["sname"] . " - " . $s["class"]) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label>

        <label>Subject
            <select name="subjectid">
                <?php foreach ($subjects as $s): ?>
                    <option value="<?= h($s["id"]) ?>" <?= (int)$row["subjectid"] === (int)$s["id"] ? "selected" : "" ?>>
                        <?= h($s["sname"]) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label>

        <label>Date
            <input type="date" name="mdate" value="<?= h($row["mdate"]) ?>">
        </label>

        <label>Type
            <input name="type" value="<?= h($row["type"]) ?>">
        </label>

        <label>Mark
            <select name="mark">
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <option value="<?= $i ?>" <?= (int)$row["mark"] === $i ? "selected" : "" ?>>
                        <?= $i ?>
                    </option>
                <?php endfor; ?>
            </select>
        </label>

        <button type="submit">Save Changes</button>
        <a class="button secondary" href="index.php?page=table">Back</a>

    </form>
</section>