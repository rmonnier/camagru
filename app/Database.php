<?php
namespace App;
use \PDO;

class Database{
	private $pdo;

	private function getPDO() {
		if ($this->pdo === null) {
			require "../config/database.php";
			try {
				$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			} catch (PDOException $exception) {
				print "Error : " . $exception->getMessage() . ".";
				return (false);
			}
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->pdo = $pdo;
		}
		return $this->pdo;
	}

	public function getUser($login)
	{
		$pdo = $this->getPDO();
		$query = 'SELECT * FROM users WHERE login = :login LIMIT 1';
		$stmt = $pdo->prepare($query);

		$stmt->execute(array(':login' => $login));
		$stmt->setFetchMode(PDO::FETCH_CLASS , "App\Table\User");
		return ($stmt->fetch());
	}

	public function getUserByMail($mail)
	{
		$pdo = $this->getPDO();
		$query = 'SELECT * FROM users WHERE mail = :mail';
		$stmt = $pdo->prepare($query);

		$stmt->execute(array(':mail' => $mail));
		$stmt->setFetchMode(PDO::FETCH_CLASS , "App\Table\User");
		return ($stmt->fetch());
	}

	public function updateUser($login, $newPasswd)
	{
		$pdo = $this->getPDO();
		$query = 'UPDATE users SET passwd = :newPasswd WHERE login = :login;';
		$stmt = $pdo->prepare($query);
		$values = array(':login' => $login, ':newPasswd' => $newPasswd);
		$stmt->execute($values);
	}

	public function addUser($name, $surname, $mail, $login, $passwd_hash, $date_creation)
	{
		$pdo = $this->getPDO();

		$sql = 'INSERT INTO users (name, surname, mail, login, passwd, date_creation)
				VALUES (:name, :surname, :mail, :login, :passwd, :date_creation)';
		$stmt = $pdo->prepare($sql);
		$values = array(':name' => $name, ':surname' => $surname, ':mail' => $mail,
		 	':login' => $login, ':passwd' => $passwd_hash, ':date_creation' => $date_creation);
		$stmt->execute($values);
	}

	public function addImg($login, $date_creation)
	{
		$pdo = $this->getPDO();
		$sql = 'INSERT INTO imgs (login, date_creation)
				VALUES (:login, :date_creation)';
		$stmt = $pdo->prepare($sql);
		$values = array(':login' => $login, ':date_creation' => $date_creation);
		$stmt->execute($values);
		return ($pdo->lastInsertId());
	}

	public function getImg($login = false)
	{
		$pdo = $this->getPDO();
		if ($login !== false)
		{
			$sql = 'SELECT id, login, number_comments, number_likes
					FROM imgs
					WHERE login = :login
					ORDER BY date_creation DESC';
		}
		else
		{
			$sql = 'SELECT id, login, number_comments, number_likes
					FROM imgs
					ORDER BY date_creation DESC';
		}
		$stmt = $pdo->prepare($sql);
		$values = array(':login' => $login);

		$stmt->execute($values);
		$stmt->setFetchMode(PDO::FETCH_CLASS , "App\Table\Img");
		return ($stmt->fetchAll());
	}

	public function getImgById($id)
	{
		$pdo = $this->getPDO();
		if ($login !== false)
		$sql = 'SELECT *
				FROM imgs
				WHERE id = :id
				ORDER BY date_creation DESC';
		$stmt = $pdo->prepare($sql);
		$values = array(':id' => $id);

		$stmt->execute($values);
		$stmt->setFetchMode(PDO::FETCH_CLASS , "App\Table\Img");
		return ($stmt->fetch());
	}

	public function deleteImg($login, $id) {
		$pdo = $this->getPDO();
		$sql = 'DELETE FROM imgs
				WHERE login = :login AND id = :id';
		$stmt = $pdo->prepare($sql);
		$values = array(':login' => $login, ':id' => $id);
		$return = $stmt->execute($values);
		return $stmt->rowCount();
	}


	public function addLike($login, $id_img, $date_creation)
	{
		$pdo = $this->getPDO();
		$sql = 'INSERT INTO likes (id_img, login, date_creation)
				VALUES (:id_img, :login, :date_creation)';
		$stmt = $pdo->prepare($sql);
		$values = array(':id_img' => $id_img, ':login' => $login, ':date_creation' => $date_creation);
		if ($stmt->execute($values))
		{
			$lastInsertId = $pdo->lastInsertId();
			$sql = 'UPDATE imgs SET number_likes = number_likes + 1 WHERE id = :id_img';
			$stmt = $pdo->prepare($sql);
			$values = array(':id_img' => $id_img);
			$stmt->execute($values);
		}
		else
			$lastInsertId = -1;
		return ($lastInsertId);
	}

	public function numberLikes($id_img)
	{
		$pdo = $this->getPDO();
		$sql = 'SELECT COUNT(*)
				FROM likes
				WHERE id_img = :id_img';
		$stmt = $pdo->prepare($sql);
		$values = array(':id_img' => $id_img);

		$stmt->execute($values);
		return ($stmt->fetchColumn());
	}

	public function isLiked($id_img, $login)
	{
		$pdo = $this->getPDO();
		if ($login === false)
			return false;
		$sql = 'SELECT COUNT(*)
				FROM likes
				WHERE id_img = :id_img AND login = :login';
		$stmt = $pdo->prepare($sql);
		$values = array(':id_img' => $id_img, ':login' => $login);

		$stmt->execute($values);
		return ($stmt->fetchColumn());
	}

	public function deleteLike($login, $id_img) {
		$pdo = $this->getPDO();
		$sql = 'DELETE FROM likes
				WHERE login = :login AND id_img = :id_img';
		$stmt = $pdo->prepare($sql);
		$values = array(':login' => $login, ':id_img' => $id_img);
		if ($stmt->execute($values))
		{
			$sql = 'UPDATE imgs SET number_likes = number_likes - 1 WHERE id = :id_img';
			$stmt = $pdo->prepare($sql);
			$values = array(':id_img' => $id_img);
			$stmt->execute($values);
		}
		return $stmt->rowCount();
	}


	public function addComment($login, $comment, $id_img, $date_creation)
	{
		$pdo = $this->getPDO();
		$sql = 'INSERT INTO comments (id_img, comment, login, date_creation)
				VALUES (:id_img, :comment, :login, :date_creation)';
		$stmt = $pdo->prepare($sql);
		$values = array(':id_img' => $id_img, ':comment' => $comment, ':login' => $login, ':date_creation' => $date_creation);
		if ($stmt->execute($values))
		{
			$lastInsertId = $pdo->lastInsertId();
			$sql = 'UPDATE imgs SET number_comments = number_comments + 1 WHERE id = :id_img';
			$stmt = $pdo->prepare($sql);
			$values = array(':id_img' => $id_img);
			$stmt->execute($values);
		}
		else
			$lastInsertId = -1;
		return ($lastInsertId);
	}

	public function numberComments($id_img)
	{
		$pdo = $this->getPDO();
		if ($login !== false)
		$sql = 'SELECT COUNT(*)
				FROM comments
				WHERE id_img = :id_img';
		$stmt = $pdo->prepare($sql);
		$values = array(':id_img' => $id_img);

		$stmt->execute($values);
		return ($stmt->fetchColumn());
	}

	public function getComments($id_img)
	{
		$pdo = $this->getPDO();
		if ($login !== false)
		$sql = 'SELECT id, login, comment, date_creation
				FROM comments
				WHERE id_img = :id_img
				ORDER BY date_creation DESC';
		$stmt = $pdo->prepare($sql);
		$values = array(':id_img' => $id_img);

		$stmt->execute($values);
		$stmt->setFetchMode(PDO::FETCH_CLASS , "App\Table\Comment");
		return ($stmt->fetchAll());
	}

	public function deleteComment($login, $id) {
		$pdo = $this->getPDO();
		$sql = 'DELETE FROM comments
				WHERE login = :login AND id = :id';
		$stmt = $pdo->prepare($sql);
		$values = array(':login' => $login, ':id' => $id);
		if ($stmt->execute($values))
		{
			$sql = 'UPDATE imgs SET number_comments = number_comments - 1 WHERE id = :id_img';
			$stmt = $pdo->prepare($sql);
			$values = array(':id_img' => $id_img);
			$stmt->execute($values);
		}
		return $stmt->rowCount();
	}
}


?>
