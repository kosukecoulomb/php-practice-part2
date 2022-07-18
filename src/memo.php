<?php

function createMemo()
{
    echo 'タイトル:';
    $title = trim(fgets(STDIN));
    echo '内容:';
    $body = trim(fgets(STDIN));
    echo '登録が完了しました' . PHP_EOL . PHP_EOL;
    return [
        'title' => $title,
        'body' => $body,
    ];
}

function listMemos($memos)
{
    foreach ($memos as $memo) {
        echo $memo['title'] . PHP_EOL;
        echo $memo['body'] . PHP_EOL;
        echo '-------' . PHP_EOL;
    };
}

$memos = [];

while (true) {
    echo '1,メモを取る' . PHP_EOL;
    echo '2,メモを表示' . PHP_EOL;
    echo '9,メモアプリを終了' . PHP_EOL;
    echo '番号を選択してください(1,2,9):';
    $num = trim(fgets(STDIN));

    if ($num === '1') {
        $memos[] = createMemo();
    } elseif ($num === '2') {
        listMemos($memos);
    } elseif ($num === '9') {
        echo 'アプリを終了' . PHP_EOL;
        break;
    }
}
