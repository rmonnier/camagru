<?php
function applyFilter($imgPath, $filterId = 'filter1') {
  $destination = imagecreatefrompng($imgPath);
  if ($filterId == 'filter1')
      $logo = imagecreatefrompng("filters/stars.png");
  else if ($filterId == 'filter2')
    $logo = imagecreatefrompng("filters/palmier.png");
  else if ($filterId == 'filter3')
      $logo = imagecreatefrompng("filters/moustache.png");

  //$image = imagecreate(200,200);
  $largeur_logo = imagesx($logo);
  $hauteur_logo = imagesy($logo);
  $largeur_destination = imagesx($destination);
  $hauteur_destination = imagesy($destination);

  if ($filterId == 'filter1')
  {
      $destination_x = $largeur_logo / 3 + 100;
      $destination_y = $hauteur_logo / 3;
      $logo = imagecreatefrompng("filters/stars.png");
    }
  else if ($filterId == 'filter2')
  {
    $destination_x = $largeur_logo / 3 + 120;
    $destination_y = $hauteur_logo / 3 + 150;
    $logo = imagecreatefrompng("filters/palmier.png");
  }
  else if ($filterId == 'filter3')
  {
      $destination_x = $largeur_logo / 3;
      $destination_y = $hauteur_logo / 3;
      $logo = imagecreatefrompng("filters/moustache.png");
    }

  // On met le logo dans l'image de destination (la photo)
  imagecopyresized($destination, $logo, 0, 0, 0, 0, $destination_x, $destination_y, $largeur_logo, $hauteur_logo);

  // On affiche l'image de destination qui a été fusionnée avec le logo
  imagepng($destination, $imgPath);
  return ($imgPath);
}
?>
