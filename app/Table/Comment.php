<?php
namespace App\Table;


class Comment{
  private $id;
  private $login;
  private $comment;
  private $date_creation;

  public function getComment() {
    date_default_timezone_set('Europe/Paris');
    $comment = '<div idcomment="' . $this->id . '">';
    $comment .= '<span>' . $this->comment . '</span></br>';
    $comment .= '<sup>' . $this->login . ' </sup>';
    $comment .= '<sup>' . date("H\hi d/m/y", strtotime($this->date_creation));
    $comment .= '</sup>';
    $comment .= '</div>';
    return $comment;
  }

}
?>
