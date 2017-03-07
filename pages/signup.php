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
		echo "<p>Please enter your email.</p>";
	else if ($db->getUserByMail($mail) != false)
		echo "<p>The email is already associated with an account.</p>";
	else if (strlen($login) <= 0)
		echo "<p>Please enter your login.</p>";
	else if ($db->getUser($login) != false)
		echo "<p>This login is already used.</p>";
	else if (!validPassword($passwd))
		echo "<p>Password must contain at least 8 characters with 1 uppercase, 1 lowercase and 1 digit.</p>";
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

?>
<header>
	<h1>Camagru</h1>
</header>
<p>Create your account :</p>
<form method="post" action="#">
	Surname: <input type="text" name="surname" <?php keepValues($surname);?>/>   Name: <input type="text" name="name" <?php keepValues($name);?>/>
	Mail: <input type="email" name="mail" <?php keepValues($mail);?>/>
	Login: <input type="text" name="login" <?php keepValues($login);?>/>   Password <input type="password" name="passwd" <?php keepValues($_POST['passwd']);?>/>
	<input type="submit" value="OK" />
</form>
