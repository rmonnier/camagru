<?php
namespace App\Table;


class Img{
	private $login;
	private $id;

	public function getEncodedData() {
		$path = "../database/" . $this->login . "/" . $this->id . ".png";
		if (!file_exists($path))
			return -1;
		$data = file_get_contents($path);
		$encodedData = base64_encode($data);
		return $encodedData;
	}

	public function displayImg() {
		$encodedData = $this->getEncodedData();
		if ($encodedData == -1)
			return ;
		$img = '<div class="img-container flex-item">';
		$img .= '<img id=' . $this->id . ' class="photo" alt="photo" ';
		$img .= 'src=data:image/png;base64,' . $encodedData . '>';
		$img .= '<div class="deletebutton">';
		$img .= '<svg class="icon-logo-delete" xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" viewBox="0 0 512 640" x="0px" y="0px"><defs><style>.cls-1{fill:none;}</style></defs><title>d10</title>';
		$img .= '<path class="cls-1" d="M256.29,465.28c115.28-.09,209.11-94.15,209-209.52S371.2,46.73,255.75,46.83s-209,94-208.93,209.46S140.85,465.37,256.29,465.28ZM181.66,180.54c11.41-10.79,23.26-6.37,33.16,4.18,12.72,13.56,25.39,27.18,41.19,44.1,16.31-17.42,29.37-31.59,42.68-45.52,9.66-10.12,21.26-12.64,31.69-2.7,11.34,10.81,8.54,22.81-2.14,33.08-13.85,13.32-27.93,26.4-45.06,42.55,16.44,15.28,30.51,28.25,44.46,41.35,10.67,10,14.39,21.93,3.36,33.11s-22.89,7.78-33.16-2.78l-42.57-43.78c-15,15.93-28,30-41.3,43.85-10.19,10.67-22.22,13.81-33.13,2.6s-7-23.06,3.58-33.12c13.52-12.82,27-25.65,46.1-43.76-16.41-13.91-31.21-26-45.48-38.7C173.57,204.81,169.3,192.22,181.66,180.54Z"/>';
		$img .= '<path d="M256.49,512C396.74,511.63,511.56,396.87,512,256.59,512.44,116.55,398.19,1.28,257.68,0S0.5,114.25,0,255.41C-0.5,396.19,115.63,512.37,256.49,512ZM255.75,46.83c115.45-.1,209.41,93.6,209.52,208.93s-93.71,209.43-209,209.52-209.37-93.63-209.46-209S140.36,46.94,255.75,46.83Z"/>';
		$img .= '<path d="M185,215c14.27,12.69,29.07,24.79,45.48,38.7-19.07,18.11-32.58,30.94-46.1,43.76-10.61,10.06-14.53,21.85-3.58,33.12s22.93,8.07,33.13-2.6c13.25-13.87,26.31-27.92,41.3-43.85l42.57,43.78c10.27,10.56,22.19,13.91,33.16,2.78s7.31-23.09-3.36-33.11c-13.95-13.1-28-26.08-44.46-41.35,17.13-16.15,31.21-29.24,45.06-42.55,10.69-10.27,13.49-22.27,2.14-33.08-10.43-9.94-22-7.41-31.69,2.7-13.3,13.94-26.37,28.1-42.68,45.52-15.8-16.92-28.46-30.54-41.19-44.1-9.9-10.55-21.75-15-33.16-4.18C169.3,192.22,173.57,204.81,185,215Z"/></svg></div></div>';
		return $img;
	}

	public function displayImg2() {
		$encodedData = $this->getEncodedData();
		if ($encodedData == -1)
			return ;
		$img = '<img id=' . $this->id . ' class="photo" alt="photo" ';
		$img .= 'src=data:image/png;base64,' . $encodedData . '>';
		return $img;
	}

	public function getId() {
		return $this->id;
	}

	public function getLogin() {
		return $this->login;
	}

}
?>
