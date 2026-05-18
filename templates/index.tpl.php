<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= h($window_title) ?> - Student Grade Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/table.css">

    <script src="scripts/validation.js" defer></script>
</head>
<body>

<header class="site-header">
    <div class="header-top">
        <div>
            <h1>Student Grade Portal</h1>
            <p>Responsive PHP web application for school marks, subjects and students</p>
        </div>

        <div class="login-status">
            <?php if (isset($_SESSION["user"])): ?>
                Logged-in:
                <strong>
                    <?= h($_SESSION["user"]["family_name"]) ?>
                    <?= h($_SESSION["user"]["surname"]) ?>
                    (<?= h($_SESSION["user"]["login_name"]) ?>)
                </strong>
            <?php else: ?>
                Not logged in
            <?php endif; ?>
        </div>
    </div>

    <nav class="menu">
        <?php foreach ($menu as $url => $text): ?>
            <a href="<?= h($url) ?>"><?= h($text) ?></a>
        <?php endforeach; ?>
    </nav>
</header>

<main class="container">

    <?php if (isset($_SESSION["error"])): ?>
        <div class="alert error">
            <?= h($_SESSION["error"]) ?>
        </div>
        <?php unset($_SESSION["error"]); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION["success"])): ?>
        <div class="alert success">
            <?= h($_SESSION["success"]) ?>
        </div>
        <?php unset($_SESSION["success"]); ?>
    <?php endif; ?>

    <?php include $template_file; ?>

</main>

<footer class="site-footer">
    <p>&copy; <?= date("Y") ?> Student Grade Portal | PHP Front Controller Seminar Homework</p>
</footer>

</body>
</html>