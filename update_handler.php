<?php
require_once("lib/bdd.php");
require_once("lib/crud.php");

$id = (int) ($_POST['id'] ?? 0);
$titre = $_POST['titre'] ?? '';
$description = $_POST['description'] ?? '';
$priorite = $_POST['priorite'] ?? 'Normale';
$date_limite = $_POST['date_limite'] ?? null;
$terminee = isset($_POST['terminee']) ? 1 : 0;

if ($id && $titre && updateTache($pdo, $id, $titre, $description, $priorite, $date_limite, $terminee)) {
    echo "OK";
} else {
    echo "Erreur lors de la mise à jour";
}
