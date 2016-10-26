<?php
//Connexion à Colodus
//Ligne 5 : RECORDER=FX correspond à iMacros dans Firefox, mettre RECORDER=CR pour iMacros dans Chrome
function loginColodus($file,$login,$password) {
fwrite($file, "VERSION BUILD=8961227 RECORDER=FX".PHP_EOL.
              "TAB T=1".PHP_EOL.
              "URL GOTO=http://colodus.sudoc.fr/".PHP_EOL.
              "TAG POS=1 TYPE=INPUT:TEXT ATTR=ID:login CONTENT=$login".PHP_EOL.
              "SET !ENCRYPTION NO".PHP_EOL.
              "TAG POS=1 TYPE=INPUT:PASSWORD ATTR=ID:pass CONTENT=$password".PHP_EOL.
              "TAG POS=1 TYPE=INPUT:SUBMIT ATTR=ID:boutonlog".PHP_EOL);
}

//Recherche par le ppn dans l'interface web de Colodus et création d'un exempalire sous ce ppn
function getScriptCreate($file,$ppn,$bib,$loc,$cote,$cb,$numinv)  {
/*Les espaces dans les champs en entrée sont à remplacer par le paramètre '<SP>' dans les scripts, par exemple
$cote = str_replace (' ','<SP>',$cote);*/
fwrite($file, "TAG POS=1 TYPE=INPUT:TEXT ATTR=ID:ppnsearch CONTENT=$ppn".PHP_EOL.
              "TAG POS=1 TYPE=INPUT:SUBMIT ATTR=ID:boutonsearch".PHP_EOL.
              "TAG POS=1 TYPE=A ATTR=TXT:Donn‚es<SP>d'exemplaires".PHP_EOL.
              "TAG POS=1 TYPE=INPUT:SUBMIT ATTR=ID:boutoncrexpl".PHP_EOL.
              "TAG POS=2 TYPE=IMG ATTR=SRC:http://colodustest.sudoc.fr/style/plus.png".PHP_EOL.
              "TAG POS=1 TYPE=A ATTR=TXT:Localisation<SP>de<SP>niveau<SP>2<SP>:<SP>Localisation<SP>co*".PHP_EOL.
              "TAG POS=1 TYPE=A ATTR=TXT:Localisation<SP>de<SP>niveau<SP>3<SP>:<SP>Localisation<SP>co*".PHP_EOL.
              "TAG POS=7 TYPE=A ATTR=TXT:+".PHP_EOL.
              "TAG POS=2 TYPE=A ATTR=ID:tree_E915".PHP_EOL.
              "TAG POS=1 TYPE=A ATTR=TXT:Num‚ro<SP>de<SP>code<SP>…<SP>barres<SP>(b)".PHP_EOL.
              "TAG POS=1 TYPE=INPUT:TEXT ATTR=ID:E915_a-* CONTENT=$numinv".PHP_EOL.
              "TAG POS=1 TYPE=INPUT:TEXT ATTR=ID:E915_b-* CONTENT=$cb".PHP_EOL.
              "TAG POS=1 TYPE=INPUT:TEXT ATTR=ID:E930_c-* CONTENT=$bib".PHP_EOL.
              "TAG POS=1 TYPE=INPUT:TEXT ATTR=ID:E930_d-* CONTENT=$loc".PHP_EOL.
              "TAG POS=1 TYPE=INPUT:TEXT ATTR=ID:E930_a-* CONTENT=$cote".PHP_EOL.
              "TAG POS=1 TYPE=INPUT:SUBMIT ATTR=ID:boutonsave1".PHP_EOL.
              "TAG POS=1 TYPE=A ATTR=TXT:Recherche".PHP_EOL);
}
//Modification de la localisation d'un exemplaire en cherchant sur le ppn
function getScriptUpdateByppn($file,$ppn,$newloc) {
fwrite($file, "TAG POS=1 TYPE=INPUT:TEXT ATTR=ID:ppnsearch CONTENT=$ppn".PHP_EOL.
              "TAG POS=1 TYPE=INPUT:SUBMIT ATTR=ID:boutonsearch".PHP_EOL.
              "TAG POS=1 TYPE=A ATTR=TXT:Donn‚es<SP>d'exemplaires".PHP_EOL.
              "TAG POS=1 TYPE=A ATTR=ID:modexpl".PHP_EOL.
              "TAG POS=1 TYPE=INPUT:TEXT ATTR=ID:E930_d-10 CONTENT=$newloc".PHP_EOL.
              "TAG POS=1 TYPE=INPUT:SUBMIT ATTR=ID:boutonsave1".PHP_EOL.
              "TAG POS=1 TYPE=A ATTR=TXT:Recherche".PHP_EOL);              
}
//Modification de la cote d'un exemplaire en cherchant sur le code barre
function getScriptUpdateBycb($file,$cb,$newcote) {
fwrite($file, "TAG POS=1 TYPE=SPAN ATTR=TXT:Autres<SP>critŠres<SP>de<SP>recherche".PHP_EOL.
              "TAG POS=1 TYPE=SELECT ATTR=ID:indexsearch0 CONTENT=%COD".PHP_EOL.
              "TAG POS=1 TYPE=INPUT:TEXT ATTR=ID:valuesearch0 CONTENT=$cb".PHP_EOL.
              "TAG POS=1 TYPE=INPUT:SUBMIT ATTR=ID:boutonsearch".PHP_EOL.
              "TAG POS=1 TYPE=A ATTR=TXT:Donn‚es<SP>d'exemplaires".PHP_EOL.
              "TAG POS=1 TYPE=A ATTR=ID:modexpl".PHP_EOL.
              "TAG POS=1 TYPE=INPUT:TEXT ATTR=ID:E930_a-41 CONTENT=$newcote".PHP_EOL.
              "TAG POS=1 TYPE=INPUT:SUBMIT ATTR=ID:boutonsave1".PHP_EOL.
              "TAG POS=1 TYPE=A ATTR=TXT:Recherche".PHP_EOL);    
}
//Suppression d'un exemplaire
function getScriptDelete($ppn) {
fwrite($file, "TAG POS=1 TYPE=INPUT:TEXT ATTR=ID:ppnsearch CONTENT=$ppn".PHP_EOL.
              "TAG POS=1 TYPE=INPUT:SUBMIT ATTR=ID:boutonsearch".PHP_EOL.
              "TAG POS=1 TYPE=A ATTR=TXT:Donn‚es<SP>d'exemplaires".PHP_EOL.
              "TAG POS=2 TYPE=A ATTR=ID:supexpl".PHP_EOL.
              "TAG POS=1 TYPE=SPAN ATTR=TXT:Supprimer".PHP_EOL.
              "TAG POS=2 TYPE=SPAN ATTR=TXT:Annuler".PHP_EOL.
              "TAG POS=1 TYPE=A ATTR=TXT:Recherche".PHP_EOL); 
}
//ajout de données locales type $alp = 'L035 ##$aALP<nønotice>' (aleph)
function getScriptLocal($ppn,$alp) {
$alp = str_replace (' ','<SP>',$alp);
fwrite($file, "TAG POS=1 TYPE=INPUT:TEXT ATTR=ID:ppnsearch CONTENT=$ppn".PHP_EOL.
              "TAG POS=1 TYPE=INPUT:SUBMIT ATTR=ID:boutonsearch".PHP_EOL.
              "TAG POS=1 TYPE=A ATTR=TXT:Donn‚es<SP>locales".PHP_EOL.
              "TAG POS=1 TYPE=INPUT:SUBMIT ATTR=ID:boutonCreloc".PHP_EOL.
              "TAB T=1".PHP_EOL.
              "TAG POS=1 TYPE=TEXTAREA ATTR=ID:ValExpl CONTENT=$alp".PHP_EOL.
              "TAG POS=1 TYPE=SPAN ATTR=TXT:Enregistrer".PHP_EOL.
              "TAG POS=1 TYPE=A ATTR=TXT:Recherche".PHP_EOL); 
}
?>
