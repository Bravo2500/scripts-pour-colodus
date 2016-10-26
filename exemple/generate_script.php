<?php
include("php_fonctions.php");
//On ouvre le fichier où va s'écrire le script (chemin relatif dans l'exemple)
$file = fopen("scripts_colodus_en_sortie.iim", "w");
//On se logge à Colodus
loginColodus($file, "votre_login_colodus", "votre_mot_de_passe_colodus");
/*On va chercher le fichier des ppn et données d'exemplaire de type
PPN;Bibliothèque;Localisation;cote;CB;Numéro d'inventaire
094665516;LASH;SL2;84/33 ROUS;0922155016;2016-DONS-LASH-304
002887673;LASH;MAG2;;ML  24364;0922154325;2016-DONS-LASH-352
001484311;LASH;SL2;842 SIM;0922155031;2016-DONS-LASH-366*/
$source_file = "fichier_exemple_en_entree.txt";
$contenu     = file_get_contents("$source_file");
$notice      = explode("\r", $contenu);
//On créé une boucle qui appelle la fonction getScriptCreate pour chaque ligne
foreach ($notice as $record) {
    $liste  = explode(';', $record);
    $ppn    = $liste[0];
    $bib    = $liste[1];
    $loc    = $liste[2];
    $cote   = str_replace(' ', '<SP>', $liste[3]);
    $cb     = $liste[4];
    $numinv = $liste[5];
    getScriptCreate($file, $ppn, $bib, $loc, $cote, $cb, $numinv);
}
fclose($file);
?>