<link href="<?= base_url('/assets/css/default.css') ?>" rel="stylesheet" type="text/css">
<div class='news'>
<?php foreach ($news as $news_item): ?>    
<?= $news_item['description'] ?>
<?php endforeach; ?>
</div>
