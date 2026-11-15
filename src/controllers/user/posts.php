<?php
require_once __DIR__ . '/../../config/bootstrap.php';

try {
    $query = '
        SELECT
            p.*,
            u.id AS user_id,
            u.name AS user_name,
            u.profile_picture AS user_pfp,
            (SELECT COUNT(*)
            FROM likes l
            WHERE l.post_id = p.id
            ) AS cantLikes,
            CASE
                WHEN EXISTS (
                    SELECT *
                    FROM likes l
                    WHERE l.user_id = :currentUser
                    AND l.post_id = p.id
                ) THEN "TRUE"
                ELSE "FALSE"
            END AS liked
        FROM posts p
        JOIN users u ON p.user_id = u.id
        WHERE p.user_id = :id
        ORDER BY created_at DESC
    ';

    $stmt = $pdo->prepare($query);
    $stmt->execute([
        'id' => $_GET['id'],
        'currentUser' => $_GET['currentUser']
    ]);

    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($posts);
} catch (PDOException $e) {
    echo $e->getMessage();
    exit('Error al consultar los posts');
}

