    <?php

    function selectPriorite(string $selected = 'Normale'): void {
        $priorites = ['Basse' => '🟢 Basse', 'Normale' => '🟡 Normale', 'Haute' => '🔴 Haute'];

        echo '<div class="mb-3">';
        echo '<label class="form-label">Priorité</label>';
        echo '<select name="priorite" class="form-select">';
        foreach ($priorites as $valeur => $label) {
            $isSelected = $valeur === $selected ? 'selected' : '';
            echo "<option value=\"$valeur\" $isSelected>$label</option>";
        }
        echo '</select>';
        echo '</div>';
    }       

  function processAddTache(PDO $pdo): ?string {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $titre = $_POST['titre'] ?? '';
        $description = $_POST['description'] ?? '';
        $priorite = $_POST['priorite'] ?? 'Normale';
        $date_limite = $_POST['date_limite'] ?? null;

        if (addTache($pdo, $titre, $description, $priorite, $date_limite, 0)) {
            echo "<script>window.parent.location.reload();</script>";
            exit;
        } else {
            return "❌ Erreur lors de l'ajout.";
        }
    }

    return null;
}

