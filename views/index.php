<?php require DIR.'views/top.php' ?>
<h1><?=$pageTitle?></h1>
<?php require DIR.'views/menu.php' ?>

<ul id="list">
    <?php foreach($boxes as $box) : ?>
    <li style="padding: 10px;">
        <span>ID: <?= $box->id ?></span>
        <span>Count: <?= $box->apple ?></span>
        <a class="btn btn-outline-success" href="<?= URL ?>edit/<?= $box->id?>">EDIT</a>
        <form style="display:inline-block;" action="<?= URL ?>delete/<?= $box->id ?>" method="post">
            <button type="submit" class="btn btn-outline-danger">DELETE</button>
        </form>
    </li>
    <?php endforeach ?>
</ul>


<?php require DIR.'views/bottom.php' ?>