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

