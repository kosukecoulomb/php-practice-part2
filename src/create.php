<?php

require_once __DIR__ . '/lib/mysqli.php';

function createReview($link, $review)
{
    $sql = <<<EOT
INSERT INTO reviews (
    title,
    author,
    status,
    score,
    impression
) VALUES (
    "{$review['title']}",
    "{$review['author']}",
    "{$review['status']}",
    "{$review['score']}",
    "{$review['impression']}"
)
EOT;
    $result = mysqli_query($link, $sql);
    if (!$result) {
        error_log('Error: fail to create review');
        error_log('Debugging Error:' . mysqli_error($link));
    }
}

function validate($review) {
    $errors = [];

    if (!strlen($review['title'])) {
        $errors['title'] = '書籍名を入力してください';
    } elseif (strlen($review['title']) > 255) {
        $errors['title'] = '書籍名は255文字以内で入力してください';
    }

    if (!strlen($review['author'])) {
        $errors['author'] = '著者名を入力してください';
    } elseif (strlen($review['author']) > 255) {
        $errors['author'] = '書籍名は255文字以内で入力してください';
    }

    if (!in_array($review['status'], ['未読', '読書中', '読了'], true)) {
        $errors['status'] = '未読,読書中,読了のいづれかを入力してください';
    }

    if ($review['score'] < 1 || $review['score'] > 5) {
        $errors['logs'] = '評価は半角1〜5で入れてください';
    }

    if (!strlen($review['impression'])) {
        $errors['impression'] = '感想を入力してください';
    } elseif (strlen($review['impression']) > 255) {
        $errors['impression'] = '感想は255文字以内で入力してください';
    }

    return $errors;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $review = [
        'title' => $_POST['title'],
        'author' => $_POST['author'],
        'status' => $_POST['status'],
        'score' => $_POST['score'],
        'impression' => $_POST['impression']
    ];
    $errors = validate($review);
    if (!count($errors)) {
        $link = dbConnect();
        createReview($link, $review);
        mysqli_close($link);
        header("Location: index.php");
    }
}

$title = '読書ログ登録';
// ここを修正
$content = __DIR__ . "/views/new.php";
include __DIR__ . '/views/layout.php';
