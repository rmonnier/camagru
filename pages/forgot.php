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

    $db->updateUser($login, $newPasswdHash);

		$subject = "Camagru - New password";
		$message = "Your new password is " . $newPasswd . " !\n";
    $newMail = new \App\Mail();
		$newMail->sendMail($mail, $subject, $message);

		header("Location: index.php");
	}
}
require "templates/header_unloggued.php";

?>

<div class="site-signin">
  <h2>Get a new password :</h2>
  <form action="#" method="post" novalidate="1" onsubmit="">
    <table cellspacing="0" role="presentation">
      <tr>
        <td>Mail: </td>
        <td><input type="email" name="mail"/></td>
      </tr>
      <tr>
        <td>Login: </td>
        <td><input type="text" name="login"/></td>
      </tr>
      <tr>
        <td></td>
        <td><input type="submit" value="OK" /></td>
      </tr>
    </table>
  </form>
</div>
