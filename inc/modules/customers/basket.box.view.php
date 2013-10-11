
<p class="menutitle">Warenkorb (<?= $product_count ?>)</p>

<form method="post">
<?= $this->insert_csrf_token('customers_basket_box') ?>

<table>
<?php foreach ($products as $r): extract($r); ?>
    <tr>
        <td><?= $name ?></td>
        <td><input name="quantity[<?= $id ?>]" value="<?= $quantity ?>" size="2" /></td>
        <td><?= $price ?></td>
    </tr>
<?php endforeach; ?>
    <tr>
        <td><a href="index.php?customers-checkout">zur Kasse</a></td>
        <td colspan="2"><input type="submit" value="refresh" /></td>
    </tr>
</table>

</form>


