<?php
require_once __DIR__ . '/../../config/bootstrap.php';

try {
    $query = '
        SELECT
            c.*,
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
        FROM comments c
        JOIN users u ON c.user_id = u.id
        WHERE post_id = :post
        ORDER BY created_at DESC
    ';

    $stmt = $pdo->prepare($query);
    $stmt->execute([
        'currentUser' => $_GET['id'],
        'post' => $_GET['post']
    ]);

    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($posts);
} catch (PDOException $e) {
    exit('Error al consultar los posts' . $e->getMessage());
}
