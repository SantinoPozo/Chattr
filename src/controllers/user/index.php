<?php
require_once __DIR__ . '/../../config/bootstrap.php';

try {
    $query = '
        SELECT
            u.id,
            u.name,
            u.profile_picture,
            (SELECT COUNT(*)
            FROM followers f
            WHERE f.followed_id = u.id
            ) AS cantSeguidores,
            (SELECT COUNT(*)
            FROM followers f
            WHERE f.follower_id = u.id
            ) AS cantSiguiendo,
            CASE
                WHEN EXISTS (
                    SELECT *
                    FROM followers f
                    WHERE f.follower_id = :currentUser
                    AND f.followed_id = u.id
                ) THEN "TRUE"
                ELSE "FALSE"
            END AS siguiendo
        FROM users u
        WHERE u.id = :id
    ';

    $stmt = $pdo->prepare($query);
   
    $stmt->execute([
        'currentUser' => $_GET['currentUser'],
        'id' => $_GET['id']
    ]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    echo json_encode($user);
} catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}