<?php
if (isset($_POST['logout']) && $_POST['logout'] == 'logout')
{
	session_destroy();
	header("Location: index.php");
}

?>
<header>
	<h1>Camagru</h1>
	<?php echo "<span>Connected as " . $_SESSION['loggued_on_user'] ."</span>"; ?>
	<form action="#" method="post" novalidate="1" onsubmit="">
		<input name="logout" value="logout" type="submit" />
	</form>
	<nav><a href="?p=profile"><strong>Profile</strong></a> <a href="?p=gallery">Gallery</a></nav>
</header>
