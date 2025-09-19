<?php

declare(strict_types=1);

namespace App\Models;

use App\DbConnection;

class TicketPurchase
{
    public static function getByToken(string $token): array | false
    {
        try {
            $dbh = DbConnection::get();
            $sql = 'SELECT * FROM ticket_purchases WHERE token = :token;';
            $pre = $dbh->prepare($sql);
            $pre->bindValue(':token', $token, \PDO::PARAM_STR);
            $pre->execute();
            $datum = $pre->fetch();
        } catch (\PDOException $e) {
            // XXX 暫定: 本来はlogに出力する & エラーページを出力する
            echo $e->getMessage();
            exit;
        }

        return $datum;
    }
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
