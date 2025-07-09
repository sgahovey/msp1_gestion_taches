<?php
require_once("lib/bdd.php");
require_once("lib/crud.php");

$order_by = $_GET['order_by'] ?? 'date_creation';
$order_dir = strtolower($_GET['order_dir'] ?? 'desc');
$order_dir = $order_dir === 'asc' ? 'asc' : 'desc'; // sécurité

$prioriteFiltre = $_GET['priorite'] ?? null;

if ($prioriteFiltre) {
    $stmt = $pdo->prepare("SELECT * FROM taches WHERE priorite = ? ORDER BY $order_by $order_dir");
    $stmt->execute([$prioriteFiltre]);
    $taches = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $stmt = $pdo->query("SELECT * FROM taches ORDER BY $order_by $order_dir");
    $taches = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
<?php if (isset($_GET['flash'])): ?>
    <div class="alert alert-success text-center">
        <?php if ($_GET['flash'] === 'add'): ?>
            ✅ Tâche créée avec succès.
        <?php elseif ($_GET['flash'] === 'update'): ?>
            ✅ Tâche modifiée avec succès.
        <?php elseif ($_GET['flash'] === 'delete'): ?>
            🗑️ Tâche supprimée avec succès.
        <?php endif; ?>
    </div>
<?php endif; ?>

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
    <th>
    <a href="?order_by=titre&order_dir=<?= ($order_by === 'titre' && $order_dir === 'asc') ? 'desc' : 'asc' ?>">
    Titre <?= $order_by === 'titre' ? ($order_dir === 'asc' ? '🔼' : '🔽') : '' ?>
    </a>
    </th><th>Description</th>
    <th>Priorité</th>
    <th> <a href="?order_by=date_limite&order_dir=<?= ($order_by === 'date_limite' && $order_dir === 'asc') ? 'desc' : 'asc' ?>">
    Date limite <?= $order_by === 'date_limite' ? ($order_dir === 'asc' ? '🔼' : '🔽') : '' ?>
    </a>
    </th>
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
<td class="text-center">
    <input type="checkbox" class="form-check-input toggle-terminee" 
        data-id="<?= $tache['id'] ?>" <?= $tache['terminee'] ? 'checked' : '' ?>>

<span class="etat-label ms-2 <?= $tache['terminee'] ? 'text-success' : 'text-warning' ?>">
    <?= $tache['terminee'] ? "✅ Terminée" : "🕒 En cours" ?>
</span>

</td>

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
        
        <script>
document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".toggle-terminee").forEach(checkbox => {
        checkbox.addEventListener("change", () => {
            const id = checkbox.dataset.id;
            const terminee = checkbox.checked ? 1 : 0;

            fetch("toggle_statut.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `id=${id}&terminee=${terminee}`
            })
            .then(res => res.json())
            .then(data => {
                if (!data.success) alert("❌ Erreur lors de la mise à jour.");
                else {
    const label = checkbox.parentElement.querySelector(".etat-label");
    label.textContent = checkbox.checked ? "✅ Terminée" : "🕒 En cours";
    label.classList.remove("text-success", "text-warning");
label.classList.add(checkbox.checked ? "text-success" : "text-warning");

}

            });
        });
    });
});
</script>

        </body>
        </html>
        