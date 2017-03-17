<?php session_start();

require "../app/Autoloader.php";
\App\Autoloader::register();

//Initialize objects

$db = new App\Database();

$p = $_GET['p'];

ob_start();
if ($_SESSION['logged_on_user'] == '')
{
	if ($p == 'signup')
		require "../pages/signup.php";
	else if ($p == 'forgot')
		require "../pages/forgot.php";
	else
		require "../pages/signin.php";
}
else
{
	if ($p == 'gallery')
  	require "../pages/gallery.php";
	else if ($p == 'comments')
	  require "../pages/comments.php";
	else if ($p == 'logout')
		require "../pages/logout.php";
	else
		require "../pages/profile.php";
}
$content = ob_get_clean();

require '../pages/templates/default.php';

?>
