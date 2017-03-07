<?php
require "templates/header_loggued.php";

?>
<section>
<div class="flex-container" id="gallery">
	<?php

	if (isset($_GET['img']))
	{
		$idImg = $_GET['img'];
		$img = $db->getImgById($idImg);
		echo $img->displayImg2();

?>
<table>
<?php
		foreach($db->getComments($idImg) as $entry)
			echo '<tr><td>' . $entry->getComment() . '</tr></td>';
	}
	?>
	<tr><td>
	<form action="ajax.php" method="post">
	  New comment <input type="text" name="comment"><br>
		<input type="hidden" name="idimg" value="<?= $idImg ?>">
		<input type="hidden" name="action" value="newcomment">
	  <input type="submit" value="submit">
	</form>
	</td></tr>
</table>
</div>
</section>
<script src="js/comments.js"></script>
