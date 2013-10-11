
<p class="menutitle">Labels</p>

<ul>
<?php foreach($labels as $r): extract($r); ?>
    <li><a href="index.php?products-<?= $id ?>-labels-<?= $this->clean_name($name) ?>"><?= $name ?></a></li>
<?php endforeach; ?>
</ul>
