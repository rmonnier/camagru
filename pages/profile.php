<?php
require "templates/header_loggued.php";

?>
<div class="all-site-wrap">
<section class="user-camera">
	<div class="container">
		<video id="video"></video>
		<canvas id="canvas"></canvas>
	</div>
	<div class="container">
		<!-- <img src="filters/stars.png" id="filter1" class="filter" alt="filter1">
		<img src="filters/palmier.png" id="filter2" class="filter" alt="filter2">
		<img src="filters/moustache.png" id="filter3" class="filter selected" alt="filter3"> -->
		Choose a filter :
		<select name="filter-selector" id="filter-selector">
			<option></option>
			 <option value="filter1">Stars</option>
			 <option value="filter2">Palmier</option>
			 <option value="filter3">Moustache</option>
		</select>
	</div>
	<div class="container">
		<div id="upload">
			<input type="file" id="fileUploaded">
		</div>
	</div>
	<div class="container">
		<button id="startbutton">Take a picture</button>
		<button id="uploadbutton">Upload a picture</button>
	</div>
</section>
<section class="gallery">
	<?php foreach($db->getImg($_SESSION['loggued_on_user']) as $entry) {
		$img = $entry->displayImgProfile();
		if ($img == -1)
			continue ;
		echo $entry->displayImgProfile();
	}
	?>
</section>
</div>
<script src="js/profile.js"></script>
