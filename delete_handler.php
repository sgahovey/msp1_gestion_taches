<?php
require_once("lib/bdd.php");
require_once("lib/crud.php");

$id = (int) ($_POST['id'] ?? 0);

if ($id && deleteTache($pdo, $id)) {
    echo "OK";
} else {
    echo "Erreur lors de la suppression";
}
