<?php
require_once(DIRECTORY_CONTROLLERS ."/IController.interface.php");

/**
* Kontroler pro stranku s uvodem
* @author                 Matěj Sochorec
*/
class UserLoginController implements IController{

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
        $tplData["username"] = "";
        $tplData["permission"] = 0;

        //** načte si data z formulare pro prihlaseni*/
        if(isset($_POST['action']) and $_POST['action'] == "login_but"){
          $login = htmlspecialchars($_POST['login']);
          $password = htmlspecialchars($_POST['password']);

          $result = $this->us->login($login, $password);

          //** načte vyskakovací zprávy s prislusnymi chybovimi hlasenimi*/
          if($result){
            $tplData["success_text"] = "Byl jste přihlášen";

            /** ziska data o prihlasenem uzivateli */
            $loggedUser = $this->us->getLoggedUserData();
            $tplData["username"] = $loggedUser["login"];
            $tplData["permission"] = $this->us->db->getPermissionDataById($loggedUser["id_permission"])['weight'];

          }else{
            $tplData["failure_text"] = "Chyba přihlášení";
            $tplData["username"] = "";
            $tplData["permission"] = 0;
          }
        }

        ob_start();

        require_once(DIRECTORY_VIEWS . "/UserLoginTemplate.tpl.php");

        return ob_get_clean();
    }

}
 ?>
