<?php
require_once __DIR__ . '/../../config/bootstrap.php';
header("Content-Type: application/json");
try {
    $usuario = $_POST['user_id'];
    $post = $_POST['post_id'];
    $stmt = $pdo->prepare('SELECT COUNT(*)
        FROM likes
        WHERE user_id = :usuario AND post_id = :post');

    $stmt->execute([
        'usuario' => $usuario,
        'post' => $post
    ]);
    $dioLike = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if($dioLike[0]["COUNT(*)"] != 0){
        $stmt = $pdo->prepare('SELECT user_id
            FROM posts
            WHERE id = :post');
        $stmt->execute([
            'post' => $post
        ]);
        $usuarioOriginal = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $emisor = $usuario;
        $receptor = $usuarioOriginal[0]['user_id'];
        include(__DIR__ . '/../notifications/delete.php');

        $stmt = $pdo->prepare('DELETE FROM likes 
        WHERE user_id = :usuario 
        AND post_id = :post');
    } else {
        $stmt = $pdo->prepare('SELECT user_id
            FROM posts
            WHERE id = :post');
        $stmt->execute([
            'post' => $post
        ]);
        $usuarioOriginal = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $emisor = $usuario;
        $receptor = $usuarioOriginal[0]['user_id'];
        $tipo = "like";
        $link = $post;
        include(__DIR__ . '/../notifications/store.php');

        $stmt = $pdo->prepare('INSERT INTO likes
        (user_id, post_id) 
        VALUES (:usuario, :post)');
    }
    $stmt->execute([
        'usuario' => $usuario,
        'post' => $post
    ]);
    echo json_encode("Exito.");
} catch (PDOException $e) {
    exit('Error al guardar el like'. $e->getMessage());
}