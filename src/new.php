<?php

$review = [
    'title' => '',
    'author' => '',
    'status' => '未読',
    'score' => '',
    'impression' => ''
];

$errors = [];

$title = '読書ログの登録';
$content = __DIR__ . '/views/new.php';
include __DIR__ . '/views/layout.php';
