<?php
    session_start();
    if(!isset($_SESSION['user_id']))
    {
        $msg = "Je moet eerst inloggen!";
        header("Location: ../login.php?msg=$msg");
        exit;
    }
?>

<?php require_once __DIR__.'/../../../config/config.php'; ?>

<!doctype html>
<html lang="nl">

<head>
    <title>StoringApp / Meldingen / Aanpassen</title>
    <?php require_once __DIR__.'/../components/head.php'; ?>
</head>

<body>
    <?php require_once __DIR__.'/../components/header.php'; ?>

    <?php
        $id = isset($_GET["id"]) ? $_GET["id"] : null;

        require_once __DIR__.'/../../../config/conn.php';
        $query = "SELECT * FROM meldings WHERE id = :id";
        $statement = $conn->prepare($query);
        $statement->execute(['id' => $id]);
        $melding = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$melding) {
            die("Melding niet gevonden.");
        }

    ?>

    <div class="edit-container">
        <h1>Melding bewerken</h1>

        <form action="../../../app/http/Controllers/meldingenController.php" method="post">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($melding['id']); ?>">

            <div class="form-group">
                <label for="attractie">Naam attractie:</label>
                <?php echo htmlspecialchars($melding['attractie']); ?>
            </div>
            <div class="form-group">
                <label for="type">Type:</label>
                <?php echo htmlspecialchars($melding['type']); ?>
            </div>

             <div class="form-group">
                <label for="capaciteit">Capaciteit per uur:</label>
                <input type="number" id="capaciteit" name="capaciteit" value="<?php echo htmlspecialchars($melding['capaciteit']); ?>">
            </div>

            <div class="form-group">
                <label for="prioriteit">Prio:</label>
                <input type="checkbox" name="prioriteit" id="prioriteit" <?php echo ($melding['prioriteit'] ? 'checked' : ''); ?>> Melding met prioriteit
            </div>


            <div class="form-group">
                <label for="melder">Melder:</label>
                <input type="text" id="melder" name="melder" value="<?php echo htmlspecialchars($melding['melder']); ?>">
            </div>

            <div class="form-group">
                <label for="overig">Overige info:</label>
                <textarea id="overig" rows="4" class="form-input" name="overig"><?php echo htmlspecialchars($melding['overige_info']); ?></textarea>
            </div>

            <div class="form-buttons">
                <button type="submit" name="action" value="update">Melding Opslaan</button>
                <button type="submit" name="action" value="delete" onclick="return confirm('Weet je zeker dat je dit bericht wilt verwijderen?');">Verwijder bericht</button>
            </div>
        </form>


    </div>
</body>
</html>
