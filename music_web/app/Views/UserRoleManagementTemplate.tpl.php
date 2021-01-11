<?php
 /** šablona*/
global $tplData;

/**  připojení objektu pro výpis základní šablony */
require(DIRECTORY_VIEWS ."/BaseTemplate.class.php");
$tplBasic = new BaseTemplate();

/** výpis hlavičky */
$tplBasic->getHTMLHeader($tplData['title'], $tplData['username'], $tplData['permission']);
?>
  <div class ="container my-5">
    <?php

    /** vypis upozorneni*/
    if(isset($tplData["failure_text_user_edit"])){
      $tplBasic->getRedAlert($tplData["failure_text_user_edit"]);
    }
    if(isset($tplData["success_text_user_edit"])){
      $tplBasic->getBlueAlert($tplData["success_text_user_edit"]);
    }

    /** zobrazi se jen po nastaveni dat*/
    if(isset($tplData["users_data"])){
      ?>
      <h1>Správa uživatelů</h1>
      <?php foreach ($tplData['users_data'] as $user) { ?>
        <div class="container allign-self-center allign-items-center">
          <form class="" action="" method="post">

            <label for="login<? echo $user['id_user'];?>" class="m-2">Uživatelské jméno: </label>
            <input class="form-control" name="user_name" id="login<?php echo $user['id_user'];?>" type="text" value="<?php echo $user['login']?>" disabled>
            <input type="hidden" name="id_user" value="<?php echo $user["id_user"]?>">

            <label for="permission<? echo $user['id_user'];?>" class="m-2">Současná role: </label>
            <input class="form-control" name="user_permission" id="permission<?php echo $user['id_user'];?>" type="text" value="<?php echo $user['permission_name']?>" disabled>
            <input type="hidden" name="last_permission" value="<?php echo $user["id_user"]?>">

            <label for="permission_select<? echo $user['id_user'];?>" class="m-2">Nová role: </label>
            <select name="next_permission" class="form-control" id="permission_select<?php echo $user['id_user'];?>">
              <?php foreach ($tplData['permissions'] as $permission) { ?>
                <option value="<?php echo $permission["id_permission"];?>" > <?php echo $permission['name']; ?> </option>
            <?php } ?>
          </select>
        <div class="row">
          <button  type="submit" name="action_change_permission" value="change_permission_but" class="btn btn-info mt-3 ml-3"> Změňit opránění </button>
          <button  type="submit" name="action_delete_user" value="delete_user_but" class="btn btn-danger mt-3 ml-3"> Vymazat uživatele </button>
          </form>
        </div>
      </div>
        </div>
      <?php
    }
    }
    ?>
  </div>

<?php

/** výpis patičky */
$tplBasic->getHTMLFooter();

?>
