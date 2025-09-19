<?php

declare(strict_types=1);

namespace App\Models;

use App\DbConnection;

class TicketPurchase
{
    // 全権取得
    public static function getAll(): array
    {

        try {
            $dbh = DbConnection::get();
            //「一覧取得」の処理を書く
            $stmt = $dbh->prepare('SELECT * FROM ticket_purchases ORDER BY created_at DESC ');
            $stmt->execute();
            $list = $stmt->fetchAll();
        } catch (\PDOException $e) {
            echo $e->getMessage();
            exit;
        }
        return $list;
    }
}
