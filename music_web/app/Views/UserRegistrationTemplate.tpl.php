<?php
 /** šablona*/
global $tplData;

/**  připojení objektu pro výpis základní šablony */
require(DIRECTORY_VIEWS ."/BaseTemplate.class.php");
$tplBasic = new BaseTemplate();

/** výpis hlavičky */
$tplBasic->getHTMLHeader($tplData['title'], $tplData['username'], $tplData['permission']);
?>
<!--  formulář pro registraci uživatele--->
<div class="container mt-3 p-3">
  <form class="mb-3 form-horizontal" role="form" method="POST" action="" oninput="notice.value=(password.value==password_repeat.value)?'OK':'Zadejte obě hesla stejně'">
    <div class="row">
      <div class="col-md-3">
      </div>
      <div class="col-md-6">
        <div class="row">
          <h1>Registrace</h1>
        </div>
        <div class="row">
          <div class="form-group has-danger">
          <div class="input-group mb-2 mr-sm-2 mb-sm-0">
            <input type="text" name="login" class="form-control" id="login" placeholder="Zadej Přihlašovací jméno" required autofocus>
          </div>
        </div>
        </div>
        <div class="row">
          <div class="form-group">
          <div class="input-group">
            <input type="password" name="password" class="form-control" id="password" placeholder="Zadej Heslo" required>
          </div>
        </div>
        </div>
        <div class="row">
          <div class="form-group">
          <div class="input-group">
            <input type="password" name="password_repeat" class="form-control" id="password_repeat" placeholder="Znovu Zadej Heslo" required>
          </div>
        </div>
        </div>
        <div class="row">
          <div class="form-control-feedback">
            <span class="text-danger align-middle"><span class="text-danger align-middle">
              <output name="notice" for="password password_repeat"></output>
            </span></span>
          </div>
        </div>
        <div class="row">
          <button type="submit" name="action" value="registration_but" class="btn btn-success">Vytvořit účet</button>
          <a class="btn btn-link" href="index.php?page=prihlaseni"> pokud ještě nemáte účet tak si ho vytvořte tady.</a>
        </div>
        <div class="row">
        </div>
      </div>
    </div>
  </form>
</div>

<?php
 /** vypis upozorneni*/
if(isset($tplData["success_text_registration"])){
  $tplBasic->getBlueAlert($tplData["success_text_registration"]);
}else if(isset($tplData["failure_text_registration"])){
  $tplBasic->getRedAlert($tplData["failure_text_registration"]);
}

/** výpis patičky */
$tplBasic->getHTMLFooter();

?>
