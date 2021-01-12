<?php
require_once(DIRECTORY_CONTROLLERS ."/IController.interface.php");

/**
* Kontroler pro stranku s uvodem
* @author                 Matěj Sochorec
*/
class UserRoleManagementController implements IController{

    /** @var UserSessions  $us sprava session uzivatele*/
    private $us;


    /** konstruktor */
    public function __construct(){
      require_once(DIRECTORY_MODELS . "/UserSessions.class.php");
      /** inicializace objekt sessonu **/
      $this->us = new UserSessions();
    }

    /**
    * vypise stranku podle nazvu stranky
    *
    * @param string $title    nazev stranky
    * @return string          HTML kod konkretni stranky
    */
    public function show(string $title): string
    {
        global $tplData;
        $tplData = [];
        $tplData["title"] = $title;

        $this->us->setUserTemplateData();

        $users_data = [];

            /** ziska data z formulare pri meneni povoleni*/
        if(isset($_POST['action_change_permission']) and $_POST['action_change_permission'] == "change_permission_but"){
          $user_id = (int)($_POST['id_user']);
          $last_permission = (int)($_POST['last_permission']);
          $next_permission = (int)($_POST['next_permission']);

            /** načte vyskakovací zprávy s prislusnymi chybovimi hlasenimi*/
          if ($user_id != $_SESSION["current_user_id"]){
            if($last_permission != $next_permission){

              $updated_user = $this->us->db->setUserPermission($user_id, $next_permission);

              if($updated_user){
                $tplData["success_text_user_edit"] = "uživatelova povolení byla upravena";
              }else {
                $tplData["failure_text_user_edit"] = "nezdařila se úprava povolení";
              }
            }else {
              $tplData["failure_text_user_edit"] = "Oprávnění se nezměnilo";
            }

          }else {
            $tplData["fauilure_text_user_edit"] = "nejde změnit vlastní povolení";
          }
        }

            /** ziska data z formulare pri mazani uzivatele*/
        if(isset($_POST['action_delete_user']) and $_POST['action_delete_user'] == "delete_user_but"){
          $user_id = (int)($_POST['id_user']);

          if($user_id == $_SESSION["current_user_id"]){
            $tplData["fauilure_text_user_edit"] = "nejde smazat vlastní účet";
          }else {
            $deleted_user = $this->us->db->DeleteUser($user_id);

            if($deleted_user){
              $tplData["success_text_user_edit"] = "Uživatel byl smazán";
            }else {
              $tplData["failure_text_user_edit"] = "Nezdařilo se smazání uživatele";
            }
          }
        }

        /** pokud ma uzivatel administratorska prava tak se nastavi informace o uzivatelich*/
        if($tplData["permission"] >= 3){
          $all_users = $this->us->db->getAllUsers();
          $all_permissions = $this->us->db->getAllPermissions();
          $i = 0;

          foreach ($all_users as $user) {
            $permission_id = $user['id_permission'];
            $permission = $this->us->db->getPermissionDataById($permission_id);
            $user['name'] = htmlspecialchars($permission["name"]);

            $users_data[$i] = array(
              'id_user' => htmlspecialchars($user["id_user"]),
              'login' => htmlspecialchars($user["login"]),
              'id_permission' => htmlspecialchars($user["id_permission"]),
              'permission_name' => htmlspecialchars($user["name"]),
            );
            $i++;
          }

          $tplData['users_data'] = $users_data;
          $tplData['permissions'] = $all_permissions;

        }

        ob_start();

        require_once(DIRECTORY_VIEWS . "/UserRoleManagementTemplate.tpl.php");

        return ob_get_clean();
    }

}
 ?>
