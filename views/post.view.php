<header class="header">
    <h2 class="header__title"><?=$post['title']?></h2>
    <div class="header__btns">
        <a href="index.php">На главную</a>
        <? if ($is_auth) : ?>
            <a href="index.php?c=edit-post&id=<?=$id?>">Редактировать</a>
        <? endif; ?>
    </div>
</header>
<h4><?=$post['dt']?></h4>
<?=nl2br($post['content'])?>