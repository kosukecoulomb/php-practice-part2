<div class="container">
    <h2 class="text-dark">読書ログの登録</h2>
    <form action="create.php" method="POST">
        <?php if (count($errors)) : ?>
            <ul>
                <?php foreach ($errors as $error) : ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <div class="form-group">
            <label for="title">書籍名</label>
            <input type="text" id="title" name="title" class="form-control" value="<?php echo $review['title'] ?>">
        </div>
        <div class="form-group">
            <label for="author">著者名</label>
            <input type="text" id="author" name="author" class="form-control" value="<?php echo $review['author'] ?>">
        </div>
        <div class="form-group">
            <label>読書状況</label>
            <div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="status" id="status1" value="未読" <?php echo ($review['status'] === '未読') ? 'checked' : ''; ?>>
                    <label for="status1" class="form-check-label">未読</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="status" id="status2" value="読書中" <?php echo ($review['status'] === '読書中') ? 'checked' : ''; ?>>
                    <label for="status2" class="form-check-label">読書中</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="status3" value="読了" <?php echo ($review['status'] === '読了') ? 'checked' : ''; ?>>
                    <label for="status3" class="form-check-label">読了</label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="score">評価(5点満点の整数)</label>
            <input type="number" id="score" name="score" value="<?php echo $review['score'] ?>">
        </div>
        <div class="form-group">
            <label for="impression">感想</label>
            <textarea type="text" id="impression" name="impression" class="form-control" rows="10"><?php echo $review['impression'] ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">登録する</button>
    </form>
</div>

