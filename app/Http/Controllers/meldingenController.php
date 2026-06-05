<?php
session_start();
$action = $_POST['action'] ?? '';

if($action == 'create'){
    $attractie = $_POST['attractie'] ?? '';
    if(empty($attractie)) {
        $errors[] = "Vul de attractie naam in.";
    }

    $capaciteit = $_POST['capaciteit'] ?? '';
    if(!is_numeric($capaciteit)) {
        $errors[] = "Vul voor capaciteit een geldig getal in.";
    }

    $melder = $_POST['melder'] ?? '';
    if(empty($melder)) {
        $errors[] = "Vul de melder in.";
    }

    $type = $_POST['type'] ?? '';
    if(empty($type)) {
        $errors[] = "Vul het type in.";
    }

    $overig = $_POST['overig'] ?? '';

    $prioriteit = isset($_POST['prioriteit']) ? 1 : 0;

    if(!empty($errors)) {
        var_dump($errors);
        die();
    }

    echo $attractie . " / " . $capaciteit . " / " . $melder;

    //1. Verbinding
    require_once '../../../config/conn.php';

    //2. Query
    $query = "INSERT INTO meldings (attractie, type, melder, overige_info, prioriteit, capaciteit)
    VALUES(:attractie, :type, :melder, :overige_info, :prioriteit, :capaciteit)";

    //3. Prepare
    $statement = $conn->prepare($query);

    //4. Execute
    $statement->execute([
        ":attractie" => $attractie,
        ":type" => $type,
        ":melder" => $melder,
        ":overige_info" => $overig,
        ":prioriteit" => $prioriteit,
        ":capaciteit" => $capaciteit,
    ]);

    $items = $statement->fetchAll(PDO::FETCH_ASSOC);

    header("Location: ../../../resources/views/meldingen/index.php?msg=Melding opgeslagen");
    exit;
}
if ($action == 'update') {
    $errors = [];

    $id = $_POST['id'] ?? '';
    if (!is_numeric($id)) {
        die("Ongeldig ID.");
    }

    $capaciteit = $_POST['capaciteit'] ?? '';
    if (!is_numeric($capaciteit) || $capaciteit <= 0) {
        $errors[] = "Vul een geldige capaciteit in.";
    }

    $melder = $_POST['melder'] ?? '';
    if (empty($melder)) {
        $errors[] = "Vul de melder in.";
    }

    $overig = $_POST['overig'] ?? '';
    $prioriteit = isset($_POST['prioriteit']) ? 1 : 0;

    if (!empty($errors)) {
        var_dump($errors);
        die();
    }

    $query = "UPDATE meldings SET capaciteit = :capaciteit, melder = :melder, overige_info = :overige_info, prioriteit = :prioriteit WHERE id = :id";
    require_once '../../../config/conn.php';
    $statement = $conn->prepare($query);
    $statement->execute([
        ":capaciteit" => $capaciteit,
        ":melder" => $melder,
        ":overige_info" => $overig,
        ":prioriteit" => $prioriteit,
        ":id" => $id
    ]);

    header("Location: ../../../resources/views/meldingen/index.php?msg=Melding Bijgewerkt");
    exit;

} elseif ($action == 'delete') {
    $id = $_POST['id'] ?? '';
    if (!is_numeric($id)) {
        die("Ongeldig ID.");
    }

    $query = "DELETE FROM meldingen WHERE id = :id";
    $statement = $conn->prepare($query);
    $statement->execute([':id' => $id]);

    header("Location: ../../../resources/views/meldingen/index.php?msg=Melding Verwijderd");
    exit;
}
