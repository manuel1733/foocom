<?php

$design->header('Login / Registrieren');

?>



<?php

if (!empty($message)) {
    echo $message . '<br><br>';
}
?>

<table>
    <tr>
        <td width="50%">
            <h2>Anmelden</h2>

            <form action="index.php?customers-checkout" method="post">
                <?= $this->insert_csrf_token('customers-login') ?>
                <table>
                    <tr>
                        <td>E-Mail</td>
                        <td><input name="mail" /></td>
                    </tr>
                    <tr>
                        <td>Passwort</td>
                        <td><input type="password" name="password" /></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" value="anmelden" /></td>
                    </tr>
                </table>
            </form>
        </td>
        <td>
            <h2>Registrieren</h2>

            <form action="index.php?customers-checkout" method="post">
                <?= $this->insert_csrf_token('customers-register') ?>
                <table>
                	<tr>
                		<td>Name</td>
                		<td><input name="name" value="<?= $name ?>" /></td>
                	</tr>
                	<tr>
                		<th colspan="2">Adresse</th>
                	</tr>
                	<tr>
                		<td>Zusatz</td>
                		<td><input name="addition" value="<?= $addition ?>" /></td>
                	</tr>
                	<tr>
                		<td>Strasse / Nr.</td>
                		<td><input name="street" value="<?= $street ?>" /></td>
                	</tr>
                	<tr>
                		<td>PLZ</td>
                		<td><input name="zipcode" value="<?= $zipcode ?>" /></td>
                	</tr>
                	<tr>
                		<td>Ort</td>
                		<td><input name="city" value="<?= $city ?>" /></td>
                	</tr>
                	<tr>
                		<td>Land</td>
                		<td><select name="country"><?= $this->out_options($countries, $country) ?></select></td>
                	</tr>
                	<tr>
                		<th colspan="2">Kontakt</th>
                	</tr>
                	<tr>
                		<td>Telefon</td>
                		<td><input name="tel" value="<?= $tel ?>" /></td>
                	</tr>
                	<tr>
                		<td>Fax</td>
                		<td><input name="fax" value="<?= $fax ?>" /></td>
                	</tr>
                	<tr>
                		<td>Mail</td>
                		<td><input name="mail" value="<?= $mail ?>" /></td>
                	</tr>
                	<tr>
                		<th colspan="2">Passwort</th>
                	</tr>
                	<tr>
                	    <td>Passwort</td>
                	    <td><input type="password" name="password1" /></td>
            	    </tr>
            	    <tr>
            	        <td>Best&auml;tigen</td>
            	        <td><input type="password" name="password2" /></td>
        	        </tr>
                	<tr>
                		<td></td>
                		<td><input value="registrieren" type="submit" /></td>
                	</tr>
                </table>
            </form>
        </td>
</table>


<?php

$design->footer();

