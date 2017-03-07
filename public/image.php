<?php
function applyFilter($imgPath, $filterId = 'filter1') {
  $destination = imagecreatefrompng($imgPath);
  if ($filterId == 'filter1')
      $logo = imagecreatefrompng("filters/apple.png");
  else if ($filterId == 'filter2')
      $logo = imagecreatefrompng("filters/palmier.png");
  else if ($filterId == 'filter3')
      $logo = imagecreatefrompng("filters/minidoritos.png");
  //$image = imagecreate(200,200);

  $largeur_logo = imagesx($logo);
  $hauteur_logo = imagesy($logo);
  $largeur_destination = imagesx($destination);
  $hauteur_destination = imagesy($destination);

  $destination_x = ($largeur_destination - $largeur_logo) / 2;
  $destination_y = $hauteur_destination - $hauteur_logo + 5;

  // On met le logo dans l'image de destination (la photo)
  imagecopymerge($destination, $logo, $destination_x, $destination_y, 0, 0, $largeur_logo, $hauteur_logo, 40);

  // On affiche l'image de destination qui a été fusionnée avec le logo
  imagepng($destination, $imgPath);
  return ($imgPath);
}
?>
