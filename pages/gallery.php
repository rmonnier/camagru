<?php
require "templates/header_loggued.php";

?>
<div class="all-site-wrap">
<section>
<div class="flex-container" class="gallery">
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
			$idImg = $entry->getId();
			$login = $_SESSION['loggued_on_user'];

			?>
			<div class="img-container img-container-gallery">
				<?= $entry->displayImg2(); ?>
			<div>
			<span>
				<span class="number"> <?= $entry->number_likes; ?>
				</span>
				&#128077;
			</span>
			<a class="like" href="#"><?= $db->isLiked($idImg, $login) == 1 ? "Unlike" : "Like";?></a>
			<span> - <?= $entry->number_comments; ?>
			</span>
			<a href="index.php?p=comments&img=<?= $idImg; ?>">Comments</a>
			</div>
			</div>
			<?php
		}
	}
?>
	</div>
	<div width="100%">Page :
		<?php
			for ($i = 1; $i <= $numberPages; $i++)
			{
				if ($i == $actualPage)
					echo ' [ '.$i.' ] ';
			  else
					echo ' <a href="index.php?p=gallery&page=' . $i . '">' . $i . '</a> ';
			}
		?>
</div>
</section>
</div>
<script src="js/gallery.js"></script>
