<?php
try {
        $query = '
            INSERT INTO notifications (emisor_id, receptor_id, type, link) VALUES (:emisor, :receptor, :type, :link)
        ';

        $stmt = $pdo->prepare($query);
    
        $stmt->execute([
            'emisor' => "743417ec-deaf-11f1-b402-40167e67060e",
            'receptor' => "c1eeb96f-de06-11f1-a8ab-40167e67060e",
            'type' => "like",
            'link' => "89e8b802-e065-11f1-95e9-40167e67060e"
        ]);

    } catch (PDOException $e) {
        return $e->getMessage();
    }