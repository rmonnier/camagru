<?php

namespace App;

class Mail{

	public function sendMail($mail, $subject, $msg) {

		//=====Déclaration des messages au format texte et au format HTML.
		$message_txt = $msg;
		$message_html = "<html><head></head><body>";
		$message_html .= $message_txt;
		$message_html .= "</body></html>";
		$passage_ligne = "\n";
		//==========

		//=====Création de la boundary
		$boundary = "-----=".md5(rand());
		$boundary_alt = "-----=".md5(rand());
		//==========

		//=====Création du header de l'e-mail.
		$header = "From: \"WeaponsB\"<rmonnier@e1z3r3p3.42.us.org>".$passage_ligne;
		$header.= "Reply-to: \"WeaponsB\" <rmonnier@e1z3r3p3.42.us.org>".$passage_ligne;
		$header.= "MIME-Version: 1.0".$passage_ligne;
		$header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
		//==========

		//=====Création du message.
		$message = $passage_ligne."--".$boundary.$passage_ligne;
		$message.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary_alt\"".$passage_ligne;
		$message.= $passage_ligne."--".$boundary_alt.$passage_ligne;
		//=====Ajout du message au format texte.
		$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
		$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
		$message.= $passage_ligne.$message_txt.$passage_ligne;
		//==========

		$message.= $passage_ligne."--".$boundary_alt.$passage_ligne;

		//=====Ajout du message au format HTML.
		$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
		$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
		$message.= $passage_ligne.$message_html.$passage_ligne;
		//==========

		//=====On ferme la boundary alternative.
		$message.= $passage_ligne."--".$boundary_alt."--".$passage_ligne;
		//==========



		$message.= $passage_ligne."--".$boundary.$passage_ligne;

		//=====Ajout de la pièce jointe.
		$message.= "Content-Type: image/jpeg; name=\"image.jpg\"".$passage_ligne;
		$message.= "Content-Transfer-Encoding: base64".$passage_ligne;
		$message.= "Content-Disposition: attachment; filename=\"image.jpg\"".$passage_ligne;
		$message.= $passage_ligne.$attachement.$passage_ligne.$passage_ligne;
		$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
		//==========
		//=====Envoi de l'e-mail.
		mail($mail,$subject,$message,$header);

		//==========
	}
}

?>
