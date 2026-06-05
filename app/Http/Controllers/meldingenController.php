<?php
session_start();
//Variabelen vullen
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
