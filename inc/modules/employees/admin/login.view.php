<?php

$menu = false;
$design->header('Login', $menu);

?>

<form action="admin.php?employees-login" method="post">
<?= $this->insert_csrf_token('employees-login') ?>

    <h1>Login</h1>
	<table>
		<tr>
			<td>Mail</td>
			<td><input name="mail" /></td>
		</tr>
		<tr>
			<td>Password</td>
			<td><input type="password" name="password" /></td>
		</tr>
		<tr>
		    <td></td>
		    <td><input type="submit" value="login" /></td>
	    </tr>
	</table>

</form>

<?php

$design->footer();
