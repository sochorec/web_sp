<?php
 /** šablona*/
global $tplData;

/**  připojení objektu pro výpis základní šablony */
require(DIRECTORY_VIEWS ."/BaseTemplate.class.php");
$tplBasic = new BaseTemplate();

/** výpis hlavičky */
$tplBasic->getHTMLHeader($tplData['title'], $tplData['username'], $tplData['permission']);

?>
  <!--  formulář pro hodnocení skladby  -->
  <div class="row">
    <div class="col-4"></div>
  <h1>Hodnocení skladby <?php echo $tplData['reviewed_song_name']?></h1>
  </div>
  <form role="form" method="POST" action="">
    <div class="form-group row">
      <label class="col-4"></label>
      <div class="col-4">
        <textarea id="textarea" name="textarea" cols="40" rows="8" class="form-control" aria-describedby="textareaHelpBlock" required="required" autofocus></textarea>
        <span id="textareaHelpBlock" class="form-text text-muted">Sem napiš svojí recenzi</span>
      </div>
    </div>
    <div class="form-group row">
      <div class="col-4"></div>
      <div class="col-8">
        <div class="custom-control custom-radio custom-control-inline">
          <input name="radio" id="radio_0" type="radio" required="required" class="custom-control-input" value="1" aria-describedby="radioHelpBlock">
          <label for="radio_0" class="custom-control-label">1</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
          <input name="radio" id="radio_1" type="radio" required="required" class="custom-control-input" value="2" aria-describedby="radioHelpBlock">
          <label for="radio_1" class="custom-control-label">2</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
          <input name="radio" id="radio_2" type="radio" required="required" class="custom-control-input" value="3" aria-describedby="radioHelpBlock">
          <label for="radio_2" class="custom-control-label">3</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
          <input name="radio" id="radio_3" type="radio" required="required" class="custom-control-input" value="4" aria-describedby="radioHelpBlock">
          <label for="radio_3" class="custom-control-label">4</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
          <input name="radio" id="radio_4" type="radio" required="required" class="custom-control-input" value="5" aria-describedby="radioHelpBlock">
          <label for="radio_4" class="custom-control-label">5</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
          <input name="radio" id="radio_5" type="radio" required="required" class="custom-control-input" value="6" aria-describedby="radioHelpBlock" checked>
          <label for="radio_5" class="custom-control-label">6</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
          <input name="radio" id="radio_6" type="radio" required="required" class="custom-control-input" value="7" aria-describedby="radioHelpBlock">
          <label for="radio_6" class="custom-control-label">7</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
          <input name="radio" id="radio_7" type="radio" required="required" class="custom-control-input" value="8" aria-describedby="radioHelpBlock">
          <label for="radio_7" class="custom-control-label">8</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
          <input name="radio" id="radio_8" type="radio" required="required" class="custom-control-input" value="9" aria-describedby="radioHelpBlock">
          <label for="radio_8" class="custom-control-label">9</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
          <input name="radio" id="radio_9" type="radio" required="required" class="custom-control-input" value="10" aria-describedby="radioHelpBlock">
          <label for="radio_9" class="custom-control-label">10</label>
        </div>
        <span id="radioHelpBlock" class="form-text text-muted">Ohodnoť skladbu od 1 do 10</span>
      </div>
    </div>
    <div class="form-group row">
      <div class="offset-4 col-8">
        <button name="action" type="submit" value="publish_but" class="btn btn-primary">Publikovat</button>
      </div>
    </div>

<?php

if(isset($tplData["success_text_review"])){
  $tplBasic->getBlueAlert($tplData["success_text_review"]);
}else if(isset($tplData["failure_text_review"])){
  $tplBasic->getRedAlert($tplData["failure_text_review"]);
}

/** výpis patičky */
$tplBasic->getHTMLFooter();

?>
