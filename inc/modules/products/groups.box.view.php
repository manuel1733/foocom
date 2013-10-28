
<p class="menutitle">Produkt Kataloge</p>

<ul>
<?php

function display_groups(array $groups) {
    foreach ($groups as $group) {
        echo '<li><a href="index.php?products-' . $group['id'] . '-groups-' . Template::clean_name($group['name']) . '">' . $group['name'] . '</a>' . "\n";
        if (!empty($group['children']) && is_array($group['children'])) {
            echo '<ul>' . "\n";
            display_groups($group['children']);
            echo '</ul>' . "\n";
        }
        echo '</li>' . "\n";
    }
}
display_groups($groups);

echo '<pre>';

// var_dump($groups);

?>
</ul>
