<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="stylesheets/css/app.css">
    <a>
        <title><?php echo $title; ?></title>
    </a>
</head>

<body>
    <header class="navbar shadow-sm p-3 mb-5 bg-white">
        <h2>
            <a class="text-body text-decoration-none" href="index.php">読書ログ</a>
        </h2>
    </header>
    <div class="container">
        <?php include $content; ?>
    </div>
</body>
