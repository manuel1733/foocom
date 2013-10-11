<p class="menutitle">Kunde</p>

<?php

if (!empty($_SESSION['customer'])) {
    echo 'Hallo ' . $_SESSION['customer']['name'] . '<br>';
}
