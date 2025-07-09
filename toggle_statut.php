<?php
require_once("lib/bdd.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $terminee = ($_POST['terminee'] === '1') ? 1 : 0;

    $stmt = $pdo->prepare("UPDATE taches SET terminee = ? WHERE id = ?");
    $success = $stmt->execute([$terminee, $id]);

    echo json_encode(['success' => $success]);
}
