<?php

function validate($memo) {
    $errors = [];

    if (!strlen($memo['title'])) {
        $errors['title'] = 'タイトルを入力してください';
    }

    if (!strlen($memo['body'])) {
        $errors['body'] = '内容を入力してください';
    }
}

$link = mysqli_connect('db', 'book_log', 'pass', 'book_log');

function dbConnect() {
    $link = mysqli_connect('db', 'book_log', 'pass', 'book_log');

    if (!$link) {
        echo 'Error: データベースに接続できませんでした' . PHP_EOL;
        echo 'Debugging error:' . mysqli_connect_error() . PHP_EOL;
        exit;
    }
}

function createMemo($link)
{
    $memo = [];

    echo 'タイトル:';
    $memo['title'] = trim(fgets(STDIN));
    echo '内容:';
    $memo['body'] = trim(fgets(STDIN));

    $validated = validate($memo);
    if (count($validated) > 0) {
        foreach ($validated as $error) {
            echo $error . PHP_EOL;
        }
        return;
    }

    $sql = <<<EOT
INSERT INTO memo (
    title,
    body
) VALUE (
    "{$memo['title']}",
    "{$memo['body']}"
)
EOT;

    $result = mysqli_query($link, $sql);
    if ($result) {
        echo 'メモを登録しました' . PHP_EOL;
    } else {
        echo 'メモの追加に失敗しました' . PHP_EOL;
        echo 'Debugging error:' . mysqli_error($link) . PHP_EOL . PHP_EOL;
    }
}

function listMemos($link)
{
$sql = 'SELECT id, title, body FROM memo';
$results = mysqli_query($link, $sql);

    while ($memo = mysqli_fetch_assoc($results)) {
        echo $memo['title'] . PHP_EOL;
        echo $memo['body'] . PHP_EOL;
        echo '-------' . PHP_EOL;
    }

    mysqli_free_result($results);
}

while (true) {
    echo '1,メモを取る' . PHP_EOL;
    echo '2,メモを表示' . PHP_EOL;
    echo '9,メモアプリを終了' . PHP_EOL;
    echo '番号を選択してください(1,2,9):';
    $num = trim(fgets(STDIN));

    if ($num === '1') {
        createMemo($link);
    } elseif ($num === '2') {
        listMemos($link);
    } elseif ($num === '9') {
        echo 'アプリを終了' . PHP_EOL;
        break;
    }
}
