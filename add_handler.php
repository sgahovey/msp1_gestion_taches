<?php
require_once("lib/bdd.php");
require_once("lib/crud.php");

$titre = $_POST['titre'] ?? '';
$description = $_POST['description'] ?? '';
$priorite = $_POST['priorite'] ?? 'Normale';
$date_limite = $_POST['date_limite'] ?? null;

if ($titre && addTache($pdo, $titre, $description, $priorite, $date_limite)) {
    echo "OK";
} else {
    echo "Erreur lors de l'ajout";
}
