
<p class="menutitle">Allergene</p>

<ul>
<?php foreach($allergens as $r): extract($r); ?>
    <li><a href="index.php?products-<?= $id ?>-allergens-<?= $this->clean_name($name) ?>"><?= $name ?></a></li>
<?php endforeach; ?>
</ul>
