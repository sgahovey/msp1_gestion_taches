<?php
require_once("lib/bdd.php");
require_once("lib/crud.php");
require_once("lib/fonctions.php");

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
    <title>Modifier la tâche</title>
    <?php require_once("lib/ui.php"); ?>
    <script src="js/update.js"></script>
</head>
<body class="p-3">
    <h4 class="mb-3">✏️ Modifier la tâche</h4>

    <form id="formUpdate" method="post">
        <input type="hidden" name="id" value="<?= $tache['id'] ?>">

        <div class="mb-3">
            <label class="form-label">Titre</label>
            <input type="text" name="titre" class="form-control" value="<?= htmlspecialchars($tache['titre']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3"><?= htmlspecialchars($tache['description']) ?></textarea>
        </div>

        <?php selectPriorite($tache['priorite']); ?>

        <div class="mb-3">
            <label class="form-label">Date limite</label>
            <input type="date" name="date_limite" class="form-control" value="<?= $tache['date_limite'] ?>">
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" class="form-check-input" name="terminee" value="1" <?= $tache['terminee'] ? 'checked' : '' ?>>
            <label class="form-check-label">✅ Tâche terminée</label>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-success">💾 Enregistrer</button>
        </div>
    </form>
</body>
</html>
