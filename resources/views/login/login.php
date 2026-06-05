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
    <?php require_once '../components/head.php'; ?>
</head>

<body>

    <div class="wrapper">
        <?php require_once '../components/header.php'; ?>

        <?php
            if(isset($_GET['msg']))
            {
            echo "<div class='msg'>" . $_GET['msg'] . "</div>";
            }
        ?>

        <div class="form_container">

            <form action="../../../app/Http/Controllers/loginController.php" method="POST">
                <div class="form-group">
                    <label for="username">Gebruikersnaam:</label>
                    <input type="text" name="username" id="username" placeholder="user1/3">
                </div>
                <div class="form-group">
                    <label for="password">Wachtwoord:</label>
                    <input type="password" name="password" id="password" placeholder="pass1/3">
                </div>
                <input type="submit" value="Login">
            </form>
        </div>
    </div>
</body>

</html>
