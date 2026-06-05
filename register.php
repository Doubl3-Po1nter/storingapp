<?php
    session_start();
    if(isset($_SESSION['user_id']))
    {
        $msg = "Je moet eerst inloggen!";
        header("Location: index.php?msg=$msg");
        exit;
    }
?>


<!doctype html>
<html lang="nl">

<head>
    <title>StoringApp</title>
    <?php require_once 'resources/views/components/head.php'; ?>
</head>

<body>

    <?php require_once 'resources/views/components/header.php'; ?>

    <?php
        if(isset($_GET['msg']))
        {
        echo "<div class='msg'>" . $_GET['msg'] . "</div>";
        }
    ?>

    <div class="form_container">

        <form action="app/Http/Controllers/registerController.php" method="POST">
            <div class="form-group">
                <label for="email">E-mailadres:</label>
                <input type="email" name="email" id="email">
            </div>
            <div class="form-group">
                <label for="password">Wachtwoord:</label>
                <input type="password" name="password" id="password">
            </div>

            <div class="form-group">
                <label for="password_check">Herhaal wachtwoord:</label>
                <input type="password" name="password_check" id="password_check" required>
            </div>
            <input type="submit" value="Registeren">
        </form>
    </div>

</body>

</html>
