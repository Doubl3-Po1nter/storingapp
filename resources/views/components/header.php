<?php require_once __DIR__.'/../../../config/config.php'; ?>

<header>
    <div class="container">
        <nav>
            <img src="<?php echo $base_url; ?>/public_html/img/logo-big-v4.png" alt="logo" class="logo">
            <a href="<?php echo $base_url; ?>/index.php">Home</a> |
            <a href="<?php echo $base_url; ?>/resources/views/meldingen/index.php">Meldingen</a>
        </nav>
        <div class="mini-container">
            <?php if(!isset($_SESSION['user_id']) == true): ?>
                <p><a href="<?php echo $base_url; ?>/resources/views/login/login.php">Inloggen</a></p>
            <?php else: ?>
                <p><a href="../login/logout.php">Uitloggen</a></p>
            <?php endif; ?>
        </div>
    </div>
</header>
