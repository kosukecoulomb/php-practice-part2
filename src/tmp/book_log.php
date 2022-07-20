<?php

function validate($log) {
    $errors = [];

    if (!strlen($log['title'])) {
        $errors['title'] = '書籍名を入力してください';
    } elseif (strlen($log['title']) > 255) {
        $errors['title'] = '書籍名は255文字以内で入力してください';
    }

    if (!strlen($log['author'])) {
        $errors['author'] = '著者名を入力してください';
    } elseif (strlen($log['author']) > 255) {
        $errors['author'] = '書籍名は255文字以内で入力してください';
    }

    if (!in_array($log['status'], [ '未読','読んでいる','読了'], true)) {
        $errors['status'] = '未読,読んでる,読了のいづれかを入力してください';
    }

    if ($log['score'] < 1 || $log['score'] > 5) {
        $errors['logs'] = '評価は半角1〜5で入れてください';
    }

    if (!strlen($log['impression'])) {
        $errors['impression'] = '感想を入力してください';
    } elseif (strlen($log['impression']) > 255) {
        $errors['impression'] = '感想は255文字以内で入力してください';
    }

    return $errors;
}

$link = mysqli_connect('db', 'book_log', 'pass', 'book_log');

function dbConnect()
{
    $link = mysqli_connect('db', 'book_log', 'pass', 'book_log');

    if (!$link) {
        echo 'Error: データベースに接続できませんでした' . PHP_EOL;
        echo 'Debugging error:' . mysqli_connect_error() . PHP_EOL;
        exit;
    }

    return $link;
}

function createLog($link)
{
    $log = [];
    echo '読書ログを登録してください' . PHP_EOL;

    echo '書籍名：';
    $log['title'] = trim(fgets(STDIN));

    echo '著者名：';
    $log['author'] = trim(fgets(STDIN));

    echo '読書状況(未読,読んでる,読了)： ';
    $log['status'] = trim(fgets(STDIN));

    echo '評価(5点満点の整数)：';
    $log['score'] = (int)trim(fgets(STDIN));

    echo '感想： ';
    $log['impression'] = trim(fgets(STDIN));

    $validated = validate($log);
    if (count($validated) > 0) {
        foreach ($validated as $error) {
            echo $error . PHP_EOL;
        }
        return;
    }

    $sql = <<<EOT
INSERT INTO booklog (
    title,
    author,
    status,
    score,
    impression
) VALUE (
    "{$log['title']}",
    "{$log['author']}",
    "{$log['status']}",
    "{$log['score']}",
    "{$log['impression']}"
)
EOT;

    $result = mysqli_query($link, $sql);
    if ($result) {
        echo 'データを追加しました' . PHP_EOL;
    } else {
        echo 'ERROR: データの追加に失敗しました' . PHP_EOL;
        echo 'Debugging error:' . mysqli_error($link) . PHP_EOL . PHP_EOL;
    }
}

function listLogs($link)
{
    $sql = 'SELECT id, title, author, status, score, impression FROM booklog';
    $results = mysqli_query($link, $sql);

    while ($log = mysqli_fetch_assoc($results)) {
        echo '読書ログを表示します' . PHP_EOL;
        echo '書籍名：' . $log['title'] . PHP_EOL;
        echo '著者名：' . $log['author'] . PHP_EOL;
        echo '読書状況(未読,読んでる,読了)：' . $log['status'] . PHP_EOL;
        echo '評価：' . $log['score'] . PHP_EOL;
        echo '感想：' . $log['impression'] . PHP_EOL;
        echo '------------------------' . PHP_EOL;
    }

    mysqli_free_result($results);
}




while (true) {
    echo '1. 読書ログを登録' . PHP_EOL;
    echo '2. 読書ログを表示' . PHP_EOL;
    echo '9. アプリケーションを終了' . PHP_EOL;
    echo '番号を選択してください(1,2,9):';
    $num = trim(fgets(STDIN));

    if ($num === '1') {
        createLog($link);
    } elseif ($num === '2') {
        listLogs($link);
    } elseif ($num === '9') {
        mysqli_close($link);
        echo 'データベースとの接続を切断しました' . PHP_EOL;
        break;
    }
}
