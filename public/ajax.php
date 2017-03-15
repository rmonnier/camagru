<?php session_start();
require "../app/Autoloader.php";
\App\Autoloader::register();

//Initialize objects

$db = new App\Database();

if (!isset($_REQUEST['action']))
	exit("No action requested.");

if ($_REQUEST['action'] == 'save')
{
	header("Content-Type: application/json");
	$encodedData = $_REQUEST['data'];
	$filterSelected = $_REQUEST['filter'];
	$encodedData = str_replace(' ','+',$encodedData);
  $decocedData = base64_decode($encodedData);
	$user = $_SESSION['loggued_on_user'];
	$imgFolder = "../database/" . $user . "/";

	date_default_timezone_set('Europe/Paris');
	$creationDate = date("Y-m-d H:i:s");
	$id = $db->addImg($user, $creationDate);

	$imgPath = $imgFolder . $id . ".png";

	if (!file_exists($imgFolder))
		mkdir($imgFolder, 0777, true);

	file_put_contents($imgPath, $decocedData);
	require "image.php";
	applyFilter($imgPath, $filterSelected);
	$img = $db->getImgById($id);
	$encodedData = $img->getEncodedData();
	echo '{ "id":' . $id . ', "src":"' . 'data:image/png;base64,' . $encodedData . '"}';
}

else if ($_REQUEST['action'] == 'delete')
{
	$id = $_REQUEST['id'];
	$user = $_SESSION['loggued_on_user'];
	$imgFolder = "../database/" . $user . "/";
	$imgPath = $imgFolder . $id . ".png";

	echo "Image deleted : " . $db->deleteImg($user, $id);
	unlink($imgPath);
}

if ($_REQUEST['action'] == 'like')
{
	$idImg = $_REQUEST['id'];
	$user = $_SESSION['loggued_on_user'];

	date_default_timezone_set('Europe/Paris');
	$creationDate = date("Y-m-d H:i:s");
	$id = $db->addLike($user, $idImg, $creationDate);
	echo $id;
}

if ($_REQUEST['action'] == 'unlike')
{
	$idImg = $_REQUEST['id'];
	$user = $_SESSION['loggued_on_user'];

	$id = $db->deleteLike($user, $idImg);
	echo $id;
}

if ($_POST['action'] == 'newcomment')
{
	$user = $_SESSION['loggued_on_user'];
	$comment = htmlentities($_POST['comment'], ENT_QUOTES | ENT_HTML5);
	$idImg = $_POST['idimg'];
	$galleryPage = $_POST['page'];

	$userOwner = $db->getImgById($idImg)->getLogin();
	$mailOwner = $db->getUser($userOwner)->getMail();
	$subject = "Camagru - New Comment";
	$message = "You've got a new comment ! Available at index.php?p=comments&img=" . $idImg . " !\n";
	$newMail = new \App\Mail();
	$newMail->sendMail($mailOwner, $subject, $message);

	date_default_timezone_set('Europe/Paris');
	$creationDate = date("Y-m-d H:i:s");
	$id = $db->addComment($user, $comment, $idImg, $creationDate);
	$newLocation = "Location: index.php?p=comments&page=" . $galleryPage . "&img=" . $idImg;
	header($newLocation);
}

?>
