<?php
$query = '
            DELETE FROM notifications WHERE emisor_id = :emisor AND receptor_id = :receptor;
        ';

$stmt = $pdo->prepare($query);

$stmt->execute([
    'emisor' => $emisor,
    'receptor' => $receptor
]);