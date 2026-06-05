<?php
    session_start();
    if(!isset($_SESSION['user_id']))
    {
        $msg = "Je moet eerst inloggen!";
        header("Location: ../login/login.php?msg=$msg");
        exit;
    }
?>
<?php require_once __DIR__.'/../../../config/config.php'; ?>
<!doctype html>
<html lang="nl">

<head>
    <title>StoringApp / Meldingen</title>
    <?php require_once __DIR__.'/../components/head.php'; ?>
</head>

<body>

    <?php require_once __DIR__.'/../components/header.php'; ?>

    <div class="container">
        <h1>Meldingen</h1>
        <a href="create.php">Nieuwe melding &gt;</a>

        <?php
            require_once '../../../config/conn.php';
            $query = "SELECT * FROM meldings";
            $statement = $conn->prepare($query);
            $statement->execute();
            $meldings = $statement->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <table>
            <tr>
                <th>Attractie</th>
                <th>Type</th>
                <th>Melder</th>
                <th>Overige info</th>
                <th>Prioriteit</th>
                <th>Aanpassen</th>
            </tr>
            <?php foreach($meldings as $melding): ?>
                <tr>
                    <td><?php echo $melding['attractie']; ?></td>
                    <td><?php echo $melding['type']; ?></td>
                    <td><?php echo $melding['melder']; ?></td>
                    <td><?php echo $melding['overige_info']; ?></td>
                    <td>
                        <?php
                        if ($melding['prioriteit'] == 1)
                        {
                            echo "Ja";
                        }
                        else
                        {
                            echo "Nee";
                        }

                        ?>
                    </td>
                    <td><a href="edit.php?id=<?php echo $melding['id']; ?>">aanpassen</a></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

</body>

</html>
