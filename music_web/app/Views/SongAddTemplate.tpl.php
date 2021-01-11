<?php
/** šablona*/
global $tplData;

/**  připojení objektu pro výpis základní šablony */
require(DIRECTORY_VIEWS ."/BaseTemplate.class.php");
$tplBasic = new BaseTemplate();

/** výpis hlavičky */
$tplBasic->getHTMLHeader($tplData['title'], $tplData['username'], $tplData['permission']);
?>
<!--  formulář přidání nové skladby  -->
</div>
<div class="container mt-3 p-3">
  <form class="mb-3 form-horizontal" role="form" method="POST" action="">
    <div class="row">
      <div class="col-md-3">
      </div>
      <div class="col-md-6">
        <div class="row">
          <h1>Přidání skladby</h1>
        </div>
        <div class="row">
          <div class="form-group has-danger">
          <div class="input-group mb-2 mr-sm-2 mb-sm-0">
            <input type="text" name="song_name" class="form-control" id="name" placeholder="Zadej Jméno skladby" required autofocus>
          </div>
        </div>
        </div>
        <div class="row">
          <div class="form-group">
          <div class="input-group">
            <input type="text" name="interpret" class="form-control" id="interpret" placeholder="Zadej Interpreta" required>
          </div>
        </div>
        </div>
        <div class="row">
          <div class="form-group">
          <div class="input-group">
            <input type="number" name="lenght" class="form-control" id="lenght" placeholder="Zadej délku skladby v minutách" required>
          </div>
        </div>
        </div>
        <div class="row">
          <div class="form-group">
          <div class="input-group">
            <input type="number" name="debut_year" class="form-control" id="debut_year" placeholder="Zadej rok vydání" required>
          </div>
        </div>
        </div>
        <div class="row">
          <button type="submit" name="action" value="add_song_but" class="btn btn-success">Vytvořit skladbu</button>
        </div>
        <div class="row">
        </div>
      </div>
    </div>
  </form>
</div>
<?php

if(isset($tplData["success_song_add"])){
  $tplBasic->getBlueAlert($tplData["success_song_add"]);
}else if(isset($tplData["failure_song_add"])){
  $tplBasic->getRedAlert($tplData["failure_song_add"]);
}

/** výpis patičky */
$tplBasic->getHTMLFooter();

?>
