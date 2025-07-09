<?php
require_once("lib/bdd.php");
require_once("lib/crud.php");
require_once("lib/fonctions.php");

$message = processAddTache($pdo);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une tâche</title>
    <?php require_once("lib/ui.php"); ?>
</head>
<body class="p-3">
    <h4 class="mb-3">➕ Nouvelle tâche</h4>

    <?php if ($message): ?>
        <div class="alert alert-danger"><?= $message ?></div>
    <?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label class="form-label">Titre</label>
            <input type="text" name="titre" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
        </div>

        <?php selectPriorite(); ?>

        <div class="mb-3">
            <label class="form-label">Date limite</label>
            <input type="date" name="date_limite" class="form-control">
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-success">✅ Ajouter</button>
        </div>
    </form>
</body>
</html>
