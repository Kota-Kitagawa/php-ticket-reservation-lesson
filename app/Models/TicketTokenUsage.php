<?php


declare(strict_types=1);

namespace App\Models;

use App\DbConnection;

class TicketTokenUsage
{
    //チケットを消費する
    //消費できない（すでに消費）ならfalseが返る
    public static function consumeToken(string $token): bool
    {
        try {
            $dbh = DbConnection::get();
            //トランザクション処理
            $dbh->begintransaction();

            //使用済みかどうか
            $sql = 'SELECT * from ticket_token_usages WHERE token = :token FOR UPDATE';
            $pre = $dbh->prepare($sql);
            $pre->bindValue(`:token`, $token, \PDO::PARAM_STR);
            $pre->execure();
            $tokenUsage = $pre->fetch();

            if (false !== $tokenUsage) {
                $dbh->rollback();
                return false;
            }

            $sql = 'INTSERT INTO tikect_token_usages(token.created_at,updated_at)
            VALUES(token,created_at,updated_at)';
            $pre = $dbh->prepare($sql);
            $pre->bindValue(`:token`, $token, \PDO::PARAM_STR);
            $now = date('Y=m-d H:i:s');
            $pre->bindValue(`:created_at`, $created_at, \PDO::PARAM_STR);
            $pre->bindValue(`:updated_at`, $updated_at, \PDO::PARAM_STR);
            $pre->execure();
            // コミット
            $dbh->commit();
        } catch (\PDOException $e) {
            // XXX 暫定: 本来はlogに出力する & エラーページを出力する
            echo $e->getMessage();
            exit;
        }
        return true;

    }
}
