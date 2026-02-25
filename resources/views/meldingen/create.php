<?php require_once __DIR__.'/../../../config/config.php'; ?>
<!doctype html>
<html lang="nl">

<head>
    <title>StoringApp / Meldingen / Nieuw</title>
    <?php require_once __DIR__.'/../components/head.php'; ?>
</head>

<body>

    <?php require_once __DIR__.'/../components/header.php'; ?>

    <div class="container">
        <h1>Nieuwe melding</h1>

        <form action="<?php echo $base_url; ?>/app/Http/Controllers/meldingenController.php" method="POST">

            <div class="form-group">
                <label for="attractie">Naam attractie:</label>
                <input type="text" name="attractie" id="attractie">
            </div>
            <div class="form-group">
                <label for="type">Type</label>
                <select name="type">
                    <option value=""> - kies een type - </option>
                    <option value="achtbaan">Achtbaan</option>
                    <option value="achtbaan">Draaiend</option>
                    <option value="achtbaan">Kinderen</option>
                    <option value="achtbaan">Horeca</option>
                    <option value="achtbaan">Show</option>
                    <option value="achtbaan">Waterattractie</option>
                    <option value="darkride">Overig</option>
                </select>
            </div>
            <div class="form-group">
                <label for="capaciteit">Capaciteit p/uur:</label>
                <input type="number" min="0" name="capaciteit" id="capaciteit">
            </div>
            <div class="form-group">
                <label for="melder">Naam melder:</label>
                <input type="text" name="melder" id="melder">
            </div>
            <div class="form-group">
                <label for="prioriteit">Prio:</label>
                <input type="checkbox" name="prioriteit" id="prioriteit" class="checkbox-input"> Melding met prioriteit
            </div>
            <div class="form-group">
                <label for="overig">Overig info:</label>
                <textarea name="overig" id="overig" class="form-input" rows="4"></textarea>
            </div>
            
            <input type="submit" value="Verstuur melding">

        </form>
    </div>

</body>

</html>
