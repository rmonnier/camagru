<?php
require "templates/header_logged.php";

?>
<div class="all-site-wrap">
<section class="gallery">
	<?php
	$numberImgsPerPage = 9;
	$imgs = $db->getImg();
	$numberImgs = count($imgs);
	$numberPages = ceil($numberImgs / $numberImgsPerPage);

	if (isset($_GET['page']))
	{
		$actualPage = intval($_GET['page']);
		if ($actualPage > $numberPages)
			$actualPage = $numberPages;
	}
	else
		$actualPage = 1;

	foreach($db->getImg() as $key => $entry)
	{
		if ($key >= ($actualPage - 1) * $numberImgsPerPage && $key <= $actualPage * $numberImgsPerPage - 1)
		{
			$img = $entry->displayImg();
			if ($img == -1)
				continue ;
			$login = $_SESSION['logged_on_user'];
			$idImg = $entry->getId();
			$numberLikes = $entry->number_likes;
			$actionLike = $db->isLiked($idImg, $login) >= 1 ? "Unlike" : "Like";
			$numberComments = $entry->number_comments;
			$addCommentLink = 'index.php?p=comments&page=' . $actualPage . '&img=' . $idImg;

			?>
			<div class="img-container img-container-gallery">
				<?= $img ?>
				<div>
					<span>
						<span class="number">
							<?= $numberLikes; ?>
						</span>
						&#128077;
					</span>
					<a class="like" href="#"><?= $actionLike; ?></a>
					<span>
						 <?= $numberComments; ?>
					</span>
					<a href="<?= $addCommentLink; ?>">Comments</a>
				</div>
			</div>
			<?php
		}
	}
?>
</section>
<nav class="pages-index-gallery">Page :
	<?php
	for ($i = 1; $i <= $numberPages; $i++)
	{
		if ($i == $actualPage)
		echo ' [ '.$i.' ] ';
		else
		echo ' <a href="index.php?p=gallery&page=' . $i . '">' . $i . '</a> ';
	}
	?>
</nav>
</div>
<script src="js/gallery.js"></script>
