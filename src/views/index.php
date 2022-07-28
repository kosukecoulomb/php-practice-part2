<h2>読書ログの登録</h2>
<a href="new.php" class="btn btn-success">新規登録</a>
<main class="m-3">
    <?php if (count($reviews) > 0) : ?>
        <?php foreach ($reviews as $review) : ?>
            <section class="card shadow-sm mb-2">
                <div class="card-body">
                    <h3><?php echo escape($review['title']); ?></h3>
                    <div>
                        <?php echo escape($review['author']); ?>
                        <?php echo escape($review['status']); ?>
                        <?php echo escape($review['score']); ?>
                    </div>
                    <p><?php echo nl2br(escape($review['impression']), false); ?></p>
                </div>
            </section>
        <?php endforeach; ?>
    <?php else : ?>
        <p>読書ログの登録がありません</p>
    <?php endif; ?>
</main>
