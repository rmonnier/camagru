<header class="site-header">
	<div class="header-profile-logo">
		<a href="?p=profile">
			<svg class="icon-logo-user" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 100 125" enable-background="new 0 0 100 100" xml:space="preserve">
				<g>
					<circle fill="none" stroke="#000000" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" cx="50" cy="36.148" r="14.271"/>
					<path fill="none" stroke="#000000" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" d="M76.705,78.123   c0-15.297-11.959-27.703-26.703-27.703c-14.75,0-26.707,12.406-26.707,27.703"/>
				</g>
			</svg>
		</a>
	</div>
	<div class="header-name">
		<h1>Camagru</h1>
	</div>
	<div class="header-gallery-logo">
		<a href="?p=gallery">
			<svg class="icon-logo-camera" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:cc="http://creativecommons.org/ns#" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd" xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" version="1.1" x="0px" y="0px" viewBox="0 0 100 125">
				<g transform="translate(0,-952.36218)">
					<path style="font-size:medium;font-style:normal;font-variant:normal;font-weight:normal;font-stretch:normal;text-indent:0;text-align:start;text-decoration:none;line-height:normal;letter-spacing:normal;word-spacing:normal;text-transform:none;direction:ltr;block-progression:tb;writing-mode:lr-tb;text-anchor:start;baseline-shift:baseline;opacity:1;color:#000000;fill:#000000;fill-opacity:1;stroke:none;stroke-width:1.99999975999999990;marker:none;visibility:visible;display:inline;overflow:visible;enable-background:accumulate;font-family:Sans;-inkscape-font-specification:Sans" d="M 20 20 C 17.247299 20 15 22.2473 15 25 L 15 67 C 15 69.7527 17.247299 72 20 72 L 38.6875 72 A 1.0000999 1.0000999 0 0 0 38.8125 72.03125 L 67.84375 79.84375 C 70.507504 80.55755 73.25606 78.94105 73.96875 76.28125 L 84.84375 35.71875 C 85.557501 33.055 83.941044 30.30644 81.28125 29.59375 L 60.9375 24.21875 C 60.556628 21.838698 58.484048 20 56 20 L 20 20 z M 20 22 L 56 22 C 57.679296 22 59 23.3207 59 25 L 59 53.78125 L 52.65625 48.25 A 1.0000999 1.0000999 0 0 0 51.40625 48.1875 L 44.0625 53.6875 L 30.6875 41.28125 A 1.0000999 1.0000999 0 0 0 29.84375 41 A 1.0000999 1.0000999 0 0 0 29.40625 41.1875 L 17 50.0625 L 17 25 C 17 23.3207 18.320704 22 20 22 z M 47 26 C 42.593567 26 39 29.59357 39 34 C 39 38.40643 42.593567 42 47 42 C 51.406434 42 55 38.40643 55 34 C 55 29.59357 51.406434 26 47 26 z M 61 26.3125 L 80.78125 31.53125 C 82.402436 31.96565 83.339585 33.60152 82.90625 35.21875 L 72.03125 75.78125 C 71.596854 77.40245 69.960976 78.33965 68.34375 77.90625 L 46.34375 72 L 56 72 C 58.752701 72 61 69.7527 61 67 L 61 26.3125 z M 47 28 C 50.325553 28 53 30.67445 53 34 C 53 37.32555 50.325553 40 47 40 C 43.674447 40 41 37.32555 41 34 C 41 30.67445 43.674447 28 47 28 z M 29.9375 43.28125 L 43.3125 55.71875 A 1.0000999 1.0000999 0 0 0 44.59375 55.8125 L 51.96875 50.28125 L 59 56.4375 L 59 67 C 59 68.6793 57.679296 70 56 70 L 20 70 C 18.320704 70 17 68.6793 17 67 L 17 52.53125 L 29.9375 43.28125 z " transform="translate(0,952.36218)"/>
				</g>
			</svg>
		</a>
	</div>
	<div class="header-logout">
		<span>Connected as <?= $_SESSION['loggued_on_user']; ?></span></br>
		<a href="?p=logout" id="logout-button">Log me out</a>
	</div>
</header>
