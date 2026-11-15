<?php
require_once __DIR__ . '/../../config/bootstrap.php';

try {
    $seguidor = $_POST['follower_id'];
    $seguido = $_POST['followed_id'];
    $stmt = $pdo->prepare('SELECT COUNT(*)
        FROM followers
        WHERE follower_id = :follower_id AND followed_id = :followed_id');

    $stmt->execute([
        'follower_id' => $seguidor,
        'followed_id' => $seguido
    ]);
    $estaSiguiendo = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if($estaSiguiendo[0]["COUNT(*)"] != 0){
        $stmt = $pdo->prepare('DELETE FROM followers 
        WHERE follower_id = :follower_id 
        AND followed_id = :followed_id');
    } else if($seguidor != $seguido){
        $stmt = $pdo->prepare('INSERT INTO followers 
        (follower_id, followed_id) 
        VALUES (:follower_id, :followed_id)');
    }
    $stmt->execute([
        'follower_id' => $seguidor,
        'followed_id' => $seguido
    ]);
    echo json_encode("Exito.");
} catch (PDOException $e) {
    exit('Error al seguir el usuario'. $e->getMessage());
}