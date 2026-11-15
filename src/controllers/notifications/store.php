<?php
        $query = '
            INSERT INTO notifications (emisor_id, receptor_id, type, link) VALUES (:emisor, :receptor, :type, :link)
        ';

        $stmt = $pdo->prepare($query);
        
        $stmt->execute([
            'emisor' => $emisor,
            'receptor' => $receptor,
            'type' => $tipo,
            'link' => $link
        ]);

