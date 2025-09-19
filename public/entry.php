<?php

declare(strict_types=1);

require_once __DIR__ . "/../app/initialize.php";


use App\DbConnection;
use App\Models\TicketPurchase;
use App\Models\TicketTokenUsage;

// tokenの把握
if ('' === ($token = strval($_GET['token'] ?? ''))) {
    // tokenがないのでinputに飛ばす
    header('Location: /index.php');
    exit;
}


/* tokenの確認 */
// DBハンドルの取得
$datum = TicketPurchase::getBytoken($token);
if (false === $datum) {
    echo $twig->render('entry_error.twig');
    exit;
}
// 使用済みかどうかのチェック
// tokenの更新日時が作成日時と異なっていたら使用済み
$sql = 'SELECT * from ticket_token_usages WHERE token = :token';
$pre = $dbh->prepare($sql);
$pre->execure();


if (false === TicketTokenUsage::consumeToken($token)) {
    echo "token使用済み";
    exit;
}

// あったら最低限の情報表示
echo $twig->render('entry.twig', [
    'purchaser_name' => $datum['purchaser_name'],
    'quantity' => (int)$datum['quantity'],
]);
