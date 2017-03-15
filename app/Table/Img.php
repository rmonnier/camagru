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
		return -1;
		$img = '<img id=' . $this->id . ' class="photo" alt="photo" ';
		$img .= 'src=data:image/png;base64,' . $encodedData . '>';
		return $img;
	}

	public function displayImgProfile() {
		$encodedData = $this->getEncodedData();
		if ($encodedData == -1)
			return -1;
		$img = '<div class="img-container">';
		$img .= '<img id=' . $this->id . ' class="photo" alt="photo" ';
		$img .= 'src=data:image/png;base64,' . $encodedData . '>';
		$img .= '<span class="deletebutton">X';
		$img .= '</span></div>';
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
