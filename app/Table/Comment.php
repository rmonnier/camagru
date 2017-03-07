<?php
namespace App\Table;


class Comment{
  private $id;
  private $login;
  private $comment;
  private $date_creation;

  public function getComment() {
    $comment = '<p idcomment="' . $this->id . '"><span>' . $this->comment;
    $comment .= '</span><span>Written by ' . $this->login . ' on ' . $this->date_creation;
    $comment .= '</span></p><br>';
    return $comment;
  }

}
?>
