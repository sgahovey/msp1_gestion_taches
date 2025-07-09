<?php

function getAllTaches(PDO $pdo): array {
    $sql = "SELECT * FROM taches ORDER BY date_creation DESC";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getTacheById(PDO $pdo, int $id): ?array {
    $stmt = $pdo->prepare("SELECT * FROM taches WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function addTache(PDO $pdo, string $titre, string $description, string $priorite, string $date_limite): bool {
    $stmt = $pdo->prepare("INSERT INTO taches (titre, description, priorite, date_limite) VALUES (?, ?, ?, ?)");
    return $stmt->execute([$titre, $description, $priorite, $date_limite]);
}

function updateTache(PDO $pdo, int $id, string $titre, string $description, string $priorite, string $date_limite, bool $terminee): bool {
    $stmt = $pdo->prepare("UPDATE taches SET titre=?, description=?, priorite=?, date_limite=?, terminee=? WHERE id=?");
    return $stmt->execute([$titre, $description, $priorite, $date_limite, $terminee, $id]);
}

function deleteTache(PDO $pdo, int $id): bool {
    $stmt = $pdo->prepare("DELETE FROM taches WHERE id = ?");
    return $stmt->execute([$id]);
}
