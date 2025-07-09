<?php
require_once("lib/ui.php");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une tâche</title>
</head>
<body class="p-3">
    <h4 class="mb-3">➕ Nouvelle tâche</h4>

    <form id="formAdd" method="post">
        <div class="mb-3">
            <label class="form-label">Titre</label>
            <input type="text" name="titre" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Priorité</label>
            <select name="priorite" class="form-select">
                <option value="Basse">🟢 Basse</option>
                <option value="Normale" selected>🟡 Normale</option>
                <option value="Haute">🔴 Haute</option>
            </select>
        </div>

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
