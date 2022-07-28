<h2 class="text-dark">会社情報の一覧</h2>
<a href="new.php" class="btn btn-primary mb-2">会社情報を登録する</a>
<main>
    <? if (count($companies) > 0) : ?>
        <?php foreach ($companies as $company) : ?>
            <section class="card shadow-sm mb-4">
                <div class="card-body">
                    <h3 class="card-title mb-3">
                        <?php echo escape($company['name']); ?>
                    </h3>
                    <div>
                        創業日：<?php echo escape($company['establishment_date']); ?>&nbsp;|&nbsp;代表：<?php echo escape($company['founder']); ?>
                    </div>
                </div>
            </section>
        <?php endforeach; ?>
    <?php else : ?>
        <p>会社情報が登録されていません</p>
    <?php endif; ?>
</main>
