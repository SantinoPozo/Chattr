<?php
require_once __DIR__ . '/../../config/bootstrap.php';

try {
    if (!isset($_POST['content'])) {
        throw new Exception('Faltan datos del formulario');
    }
    
    $stmt = $pdo->prepare('INSERT INTO comments (user_id, post_id, content) VALUES (:user_id, :post_id, :content)');

    try {
        var_dump($_SESSION);
        $stmt->execute([
            'user_id' => $_SESSION['user']['id'],
            'post_id' => $_POST['post'],
            'content' => $_POST['content']
        ]);
    } catch (PDOException $e) {
        exit($e->getMessage());
    }
    header('Location: ' . '/src/views/posts/show.php?id=' . $_POST['post']);
    exit;
} catch (PDOException $e) {
    exit('Error al crear el post'. $e->getMessage());
}