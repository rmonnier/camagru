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
		$_SESSION['logged_on_user'] = $login;
		header("Location: index.php");
	}
	else
	{
		$_SESSION['logged_on_user'] = "";
		$error = "Incorrect login or password.";
	}
}
require "templates/header_unlogged.php";

?>

<div class="site-signin">
	<form action="#" method="post" novalidate="1" onsubmit="">
		<table cellspacing="0" role="presentation">
			<tr>
				<td><label for="email">Login</label></td>
				<td><label for="pass">Password</label></td>
			</tr>
			<tr>
				<td><input type="email" name="login" value="" tabindex="1" /></td>
				<td><input type="password" name="passwd" tabindex="2" /></td>
				<td><input type="submit" value="OK" tabindex="3" /></td>
			</tr>
			<tr>
				<td>
					<div><a href="index.php?p=signup" tabindex="4">Create an account</a></div>
				</td>
				<td>
					<div><a href="index.php?p=forgot" tabindex="5">Forgot?</a></div>
				</td>
			</tr>
		</table>
	</form>
	<?php if (isset($error)) { echo "<p>" . $error . "</p>"; }?>
</div>
