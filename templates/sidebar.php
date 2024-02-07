<?php

global$categories;
?>

<div class="sidebar col-12 col-md-3">
    <!-- категории -->
    <div class="section-topic">
        <h4>Категории</h4>
        <ul>
            <?php
            foreach ($categories as $category) : ?>
                <li><a class="text-decoration-none"
                       href="<?= '/views/categories.php?post=' . $category['id']; ?>"><?= $category['title']; ?></a></li>
            <?php
            endforeach; ?>
        </ul>
    </div>
</div>
