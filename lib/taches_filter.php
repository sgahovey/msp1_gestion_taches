<?php
$order_by = $_GET['order_by'] ?? 'date_creation';
$order_dir = strtolower($_GET['order_dir'] ?? 'desc');
$order_dir = $order_dir === 'asc' ? 'asc' : 'desc';

$prioriteFiltre = $_GET['priorite'] ?? null;
$filtre = $_GET['filtre'] ?? '';

$sql = "SELECT * FROM taches";
$params = [];
$conditions = [];

if ($prioriteFiltre) {
    $conditions[] = "priorite = ?";
    $params[] = $prioriteFiltre;
}
if ($filtre === '0' || $filtre === '1') {
    $conditions[] = "terminee = ?";
    $params[] = $filtre;
}
if ($conditions) {
    $sql .= " WHERE " . implode(" AND ", $conditions);
}

$sql .= " ORDER BY $order_by $order_dir";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);

return $stmt->fetchAll(PDO::FETCH_ASSOC);
