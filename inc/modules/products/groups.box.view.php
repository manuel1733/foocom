
<p class="menutitle">Produkt Kataloge</p>

<ul>
<?php

function display_groups(array $groups) {
    $length = count($groups);
    for ($i = 0; $i < $length; $i++) {
        echo '<li><a href="index.php?products-' . $groups[$i]['id'] . '-groups-' . Template::clean_name($groups[$i]['name']) . '">' . $groups[$i]['name'] . '</a>' . "\n";
        if (($i + 1) < $length && empty($groups[$i + 1]['name'])) {
            $i++;
            echo '<ul>' . "\n";
            display_groups($groups[$i]);
            echo '</ul>' . "\n";
        }
        echo '</li>' . "\n";
    }
}

display_groups($groups);

?>
</ul>

