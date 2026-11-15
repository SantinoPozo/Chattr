<?php
require_once __DIR__ . '/../../config/bootstrap.php';

try {
    if (!isset($_POST['title'], $_POST['content'])) {
        throw new Exception('Faltan datos del formulario');
    }

    $stmt = $pdo->prepare('UPDATE users SET name = :name, description = :description WHERE id = :id');
    $stmt->execute([
        'id' => $_POST['id'],
        'name' => $_POST['name'],
        'description' => $_POST['description'],
    ]);

    header('Location: /src/controllers/posts/index.php');
    exit;
} catch (PDOException $e) {
    exit('Error al actualizar el post');
}