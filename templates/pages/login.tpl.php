<section class="grid two">

    <article class="panel">
        <h2>Login</h2>

        <?php if (isset($_SESSION["error"])): ?>
            <p class="alert error"><?= h($_SESSION["error"]) ?></p>
            <?php unset($_SESSION["error"]); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION["success"])): ?>
            <p class="alert success"><?= h($_SESSION["success"]) ?></p>
            <?php unset($_SESSION["success"]); ?>
        <?php endif; ?>

        <form method="post" action="logicals/login2.php" class="form-card">
            <label>Login name
                <input name="login_name">
            </label>

            <label>Password
                <input type="password" name="password">
            </label>

            <button type="submit">Login</button>

            <p class="small">Demo account: admin / password123</p>
        </form>
    </article>

    <article class="panel">
        <h2>Register</h2>

        <form method="post" action="logicals/register.php" class="form-card" id="registerForm">
            <label>Family name
                <input name="family_name">
            </label>

            <label>Surname
                <input name="surname">
            </label>

            <label>Login name
                <input name="login_name">
            </label>

            <label>Email
                <input name="email">
            </label>

            <label>Password
                <input type="password" name="password">
            </label>

            <button type="submit">Register</button>

            <p class="small">The user is not automatically logged in after registration.</p>
        </form>
    </article>

</section>