<?php
require_once("lib/bdd.php");
require_once("lib/crud.php");

$prioriteFiltre = $_GET['priorite'] ?? null;

if ($prioriteFiltre) {
    $stmt = $pdo->prepare("SELECT * FROM taches WHERE priorite = ? ORDER BY date_creation DESC");
    $stmt->execute([$prioriteFiltre]);
    $taches = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $taches = getAllTaches($pdo);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Liste des Tâches</title>
<?php require_once("lib/ui.php"); ?>
</head>
<body class="bg-light p-4">

<div class="container">
<h1 class="mb-4 text-center">📋 Gestion des Tâches</h1>

<div class="text-end mb-3">
<a href="add.php" class="btn btn-primary" data-fancybox data-type="iframe">
    ➕ Ajouter une tâche
</a>


</div>

<form method="get" class="mb-3 d-flex justify-content-end">
    <select name="priorite" class="form-select w-auto me-2" onchange="this.form.submit()">
        <option value="">🎯 Filtrer par priorité</option>
        <option value="Basse" <?= ($prioriteFiltre === 'Basse') ? 'selected' : '' ?>>🟢 Basse</option>
        <option value="Normale" <?= ($prioriteFiltre === 'Normale') ? 'selected' : '' ?>>🟡 Normale</option>
        <option value="Haute" <?= ($prioriteFiltre === 'Haute') ? 'selected' : '' ?>>🔴 Haute</option>
    </select>
    <?php if ($prioriteFiltre): ?>
        <a href="index.php" class="btn btn-outline-secondary">🔄 Réinitialiser</a>
    <?php endif; ?>
</form>


<table class="table table-bordered table-striped">
<thead class="table-dark">
<tr>
<th>Titre</th>
<th>Description</th>
<th>Priorité</th>
<th>Date limite</th>
<th>État</th>
<th>Actions</th>
</tr>
</thead>
<tbody>
<?php foreach ($taches as $tache): ?>
    <tr>
    <td><?= htmlspecialchars($tache['titre']) ?></td>
    <td><?= nl2br(htmlspecialchars($tache['description'])) ?></td>
    <td><?= htmlspecialchars($tache['priorite']) ?></td>
    <td><?= date("d/m/Y", strtotime($tache['date_limite'])) ?></td>
    <td><?= $tache['terminee'] ? "✅ Terminée" : "🕒 En cours" ?></td>
    <td>
<a href="update.php?id=<?= $tache['id'] ?>" class="btn btn-sm btn-warning" data-fancybox data-type="iframe">
    ✏️
</a>
<a href="delete.php?id=<?= $tache['id'] ?>" class="btn btn-sm btn-danger" data-fancybox data-type="iframe">
    🗑️
</a>
    </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
    </table>
    </div>
    
    </body>
    </html>
    