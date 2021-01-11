<?php
 /** šablona*/
global $tplData;

/**  připojení objektu pro výpis základní šablony */
require(DIRECTORY_VIEWS ."/BaseTemplate.class.php");
$tplBasic = new BaseTemplate();

/** výpis hlavičky */
$tplBasic->getHTMLHeader($tplData['title'], $tplData['username'], $tplData['permission']);
?>

<div class="container text-center">
  <h1>Byl jste odhlášen</h1>
  <a href="index.php?page=uvod"> Zpět do úvodu </a>
</div>

<?php

/** výpis patičky */
$tplBasic->getHTMLFooter();

?>
