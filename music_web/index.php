<?php
/************ vstupni bod aplikace ************/

/** nactu funkci vlastniho autoloaderu trid */
/** pozn.: protoze je pouzit autoloader trid, tak toto je (vyjma TemplateBased sablon) jediny soubor aplikace, ktery pouziva funkci require_once */


require_once("settings.inc.php");

require_once("app/ApplicationStart.class.php");

/** spustim aplikaci */
$app = new ApplicationStart();
$app->appStart();

?>
