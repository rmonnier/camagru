<?php
require "templates/header_logged.php";

?>
<div class="all-site-wrap">
<section class="gallery">
<div class="img-container img-container-gallery">
<?php
	if (isset($_GET['img']))
	{
		$idImg = $_GET['img'];
		$img = $db->getImgById($idImg);
		$galleryPage = $_GET['page'];
		$backToGalleryLink = 'index.php?p=gallery&page=' . $galleryPage;
		echo $img->displayImg();

?>
<table>
<?php foreach($db->getComments($idImg) as $entry) { ?>
	<tr><td> <?= $entry->getComment(); ?></tr></td>
<?php } ?>
	<tr>
		<td>
			<form action="ajax.php" method="post">
				<input type="text" name="comment"><br>
				<input type="hidden" name="idimg" value="<?= $idImg ?>">
				<input type="hidden" name="page" value="<?= $galleryPage ?>">
				<input type="hidden" name="action" value="newcomment">
				<input type="submit" value="submit">
			</form>
		</td>
	</tr>
</table>
<?php } ?>
<a href="<?= $backToGalleryLink; ?>">Back to gallery</a>
</div>
</section>
</div>
