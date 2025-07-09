<?php
require_once("lib/bdd.php");
require_once("lib/crud.php");

$id = $_GET['id'] ?? null;
$tache = $id ? getTacheById($pdo, (int)$id) : null;

if (!$tache) {
    echo "<div class='alert alert-danger'>❌ Tâche introuvable.</div>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Supprimer la tâche</title>
    <?php require_once("lib/ui.php"); ?>
    <script src="js/delete.js"></script>
</head>
<body class="p-3">
    <h4 class="mb-3">🗑️ Supprimer la tâche</h4>

    <div class="alert alert-warning">
        ⚠️ Confirmez-vous la suppression de cette tâche ?
        <strong><?= htmlspecialchars($tache['titre']) ?></strong>
    </div>

    <form id="formDelete" method="post">
        <input type="hidden" name="id" value="<?= $tache['id'] ?>">
        <div class="text-end">
            <button type="submit" class="btn btn-danger">✅ Oui, supprimer</button>
        </div>
    </form>
</body>
</html>
