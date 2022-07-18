<?php

function createLog()
{
    echo '読書ログを登録してください' . PHP_EOL;

    echo '書籍名：';
    $title = trim(fgets(STDIN));

    echo '著者名：';
    $author = trim(fgets(STDIN));

    echo '読書状況(未読,読んでる,読了)：';
    $status = trim(fgets(STDIN));

    echo '評価(5点満点の整数)：';
    $score = trim(fgets(STDIN));

    echo '感想：';
    $impression = trim(fgets(STDIN));

    echo '登録が完了しました' . PHP_EOL . PHP_EOL;

    return[
        'title' => $title,
        'author' => $author,
        'status' => $status,
        'score' => $score,
        'impression' => $impression,
    ];
}

function listLogs($logs)
{
    foreach ($logs as $log) {
        echo '読書ログを表示します' . PHP_EOL;
        echo '書籍名：' . $log['title'] . PHP_EOL;
        echo '著者名：' . $log['author'] . PHP_EOL;
        echo '読書状況(未読,読んでる,読了)：' . $log['status'] . PHP_EOL;
        echo '評価：' . $log['score'] . PHP_EOL;
        echo '感想：' . $log['impression'] . PHP_EOL;
        echo '------------------------' . PHP_EOL;
    };
}

$logs = [];

while (true) {
    echo '1. 読書ログを登録' . PHP_EOL;
    echo '2. 読書ログを表示' . PHP_EOL;
    echo '9. アプリケーションを終了' . PHP_EOL;
    echo '番号を選択してください(1,2,9):';
    $num = trim(fgets(STDIN));

    if ($num === '1') {
        $logs[] = createLog();
    } elseif ($num === '2') {
        listLogs($logs);
    } elseif ($num === '9') {
        break;
    }
}
