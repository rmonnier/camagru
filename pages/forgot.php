<?php

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

if (isset($_POST['login']) && isset($_POST['mail']))
{
  $login = htmlentities($_POST['login'], ENT_QUOTES | ENT_HTML5);
  $mail = $_POST['mail'];
	$user = $db->getUser($login);
	if ($user == false || $mail != $user->getMail())
		echo "<p>Incorrect login or wrong login/mail association.</p>";
	else {
		$newPasswd = generateRandomString();
		$newPasswdHash = hash('whirlpool', $newPasswd);

		$subject = "Camagru - New password";
		$message = "Your new password is " . $newPasswd . " !\n";
		mail($mail, $subject, $message);
    var_dump($newPasswd);
		$db->updateUser($login, $newPasswdHash);
		header("Location: index.php");
	}
}

?>
<header>
	<h1>Camagru</h1>
</header>
<p>Get a new password :</p>
<form method="post" action="#">
	Mail: <input type="email" name="mail"/> Login: <input type="text" name="login"/>
	<input type="submit" value="OK" />
</form>
