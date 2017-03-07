<?php

function auth($login, $passwd, $db)
{
	$user = $db->getUser($login);
	if ($user->login)
	{
		$passwd_hash = hash('whirlpool', $passwd);
		if ($passwd_hash == $user->passwd)
			return (1);
		else
			return (0);
	}
	return (0);
}

if (isset($_POST['login']) && isset($_POST['passwd']))
{
	$login = htmlentities($_POST['login'], ENT_QUOTES | ENT_HTML5);
	$ret = auth($login, $_POST['passwd'], $db);
	if ($ret == 1)
	{
		$_SESSION['loggued_on_user'] = $login;
		header("Location: index.php");
		echo "OK!";
	}
	else
	{
		$_SESSION['loggued_on_user'] = "";
		echo "<p>Incorrect login or password.</p>";
	}
}
?>
<header>
	<h1>Camagru</h1>
</header>
<form action="#" method="post" novalidate="1" onsubmit="">
	<table cellspacing="0" role="presentation">
		<tr>
			<td class="html7magic"><label for="email">Email or Phone</label></td>
			<td class="html7magic"><label for="pass">Password</label></td>
		</tr>
		<tr>
			<td><input type="email" name="login" value="" tabindex="1" /></td>
			<td><input type="password" name="passwd" tabindex="2" /></td>
			<td><input type="submit" value="OK" tabindex="3" /></td>
		</tr>
		<tr>
			<td class="login_form_label_field">
				<div><a href="index.php?p=signup" tabindex="4">Créer un compte</a></div>
			</td>
			<td class="login_form_label_field">
				<div><a href="index.php?p=forgot" tabindex="5">Mot de passe oublié?</a></div>
			</td>
		</tr>
	</table>
</form>
