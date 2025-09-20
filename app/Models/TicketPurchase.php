<?php

declare(strict_types=1);

namespace App\Models;

use App\DbConnection;

class TicketPurchase
{
    // 1カラムから１件取得
    protected static function getBy(string $col_name, string $value): array | false
    {
        $white_list = [
            'email' => true,
            'token' => true,
        ];
        if (false === isset($white_list[$col_name])) {
            echo 'カラム名おかしいです';
            exit;
        }
        try {
            $dbh = DbConnection::get();
            $sql = "SELECT * FROM ticket_purchases WHERE ($col_name) = :value;";
            $pre = $dbh->prepare($sql);
            $pre->bindValue(':value', $value, \PDO::PARAM_STR);
            $pre->execute();
            $datum = $pre->fetch();
        } catch (\PDOException $e) {
            // XXX 暫定: 本来はlogに出力する & エラーページを出力する
            echo $e->getMessage();
            exit;
        }

        return $datum;
    }

    public static function getByEmail(string $email): array | false
    {
        return static::getBy('email', $email);
    }

    public static function getByToken(string $token): array | false
    {
        return static::getBy('token', $token);
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
