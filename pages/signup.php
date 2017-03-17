<?php

function keepValues($value)
{
	if (isset($value))
		echo ' value="' . $value . '"';
}

function validPassword($pwd)
{
	return (preg_match("#(?=.{8,})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$#", $pwd));
}

if (isset($_POST['login']) && isset($_POST['mail']) && isset($_POST['passwd']))
{
	$name = htmlentities($_POST['name'], ENT_QUOTES | ENT_HTML5);
	$surname = htmlentities($_POST['surname'], ENT_QUOTES | ENT_HTML5);
	$mail = $_POST['mail'];
	$login = htmlentities($_POST['login'], ENT_QUOTES | ENT_HTML5);
	$passwd = $_POST['passwd'];

	if (strlen($mail) <= 0)
		$error = "Please enter your email.";
	else if ($db->getUserByMail($mail) != false)
		$error = "The email is already associated with an account.";
	else if (strlen($login) <= 0)
		$error = "Please enter your login.";
	else if ($db->getUser($login) != false)
		$error = "This login is already used.";
	else if (!validPassword($passwd))
		$error = "Password must contain at least 8 characters with 1 uppercase, 1 lowercase and 1 digit.";
	else
	{
		$passwd_hash = hash('whirlpool', $passwd);
		date_default_timezone_set('Europe/Paris');
		$date_creation = date("Y-m-d H:i:s");
		$db->addUser($name, $surname, $mail, $login, $passwd_hash, $date_creation);

		$subject = "Camagru - Registration completed";
		$message = "Welcome " . $name . " !\n";
		$newMail = new \App\Mail();
		$newMail->sendMail($mail, $subject, $message);

		$_SESSION['loggued_on_user'] = $login;
		header("Location: index.php");
	}
}
require "templates/header_unloggued.php";

?>
<div class="site-signin">
	<h2>Create your account :</h2>
	<form action="#" method="post">
		<table cellspacing="0" role="presentation">
			<tr>
				<td><label for="surname">Surname: </label></td>
				<td><input type="text" name="surname" <?php keepValues($surname);?>/></td>
			</tr>
			<tr>
				<td><label for="name">Name: </label></td>
				<td><input type="text" name="name" <?php keepValues($name);?>/></td>
			</tr>
			<tr>
				<td><label for="mail">Mail: </label></td>
				<td><input type="email" name="mail" <?php keepValues($mail);?>/></td>
			</tr>
			<tr>
				<td><label for="login">Login: </label></td>
				<td><input type="text" name="login" <?php keepValues($login);?>/></td>
			</tr>
			<tr>
				<td><label for="passwd">Password: </label></td>
				<td><input type="password" name="passwd" <?php keepValues($_POST['passwd']);?>/></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" value="OK"/></td>
			</tr>
		</table>
	</form>
	<?php if (isset($error)) { echo "<p>" . $error . "</p>"; }?>
</div>
