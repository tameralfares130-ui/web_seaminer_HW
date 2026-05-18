<?php
$pdo = db();

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
            "INSERT INTO marks (studentid, subjectid, mdate, mark, type)
             VALUES (?, ?, ?, ?, ?)"
        );

        $stmt->execute([$studentid, $subjectid, $mdate, $mark, $type]);

        $_SESSION["success"] = "Mark created successfully.";
        header("Location: index.php?page=table");
        exit;
    } else {
        $_SESSION["error"] = "Please fill every field correctly.";
    }
}
?>

<section class="panel">
    <h2>Create New Mark</h2>

    <form method="post" class="form-card">

        <label>Student
            <select name="studentid">
                <?php foreach ($students as $s): ?>
                    <option value="<?= h($s["id"]) ?>">
                        <?= h($s["sname"] . " - " . $s["class"]) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label>

        <label>Subject
            <select name="subjectid">
                <?php foreach ($subjects as $s): ?>
                    <option value="<?= h($s["id"]) ?>">
                        <?= h($s["sname"]) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label>

        <label>Date
            <input type="date" name="mdate" value="<?= date("Y-m-d") ?>">
        </label>

        <label>Type
            <input name="type" value="quiz">
        </label>

        <label>Mark
            <select name="mark">
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <option value="<?= $i ?>"><?= $i ?></option>
                <?php endfor; ?>
            </select>
        </label>

        <button type="submit">Create</button>
        <a class="button secondary" href="index.php?page=table">Back</a>

    </form>
</section>