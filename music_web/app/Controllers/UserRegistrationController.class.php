<?php
require_once(DIRECTORY_CONTROLLERS ."/IController.interface.php");

/**
* Kontroler pro stranku s uvodem
* @author                 Matěj Sochorec
*/
class UserRegistrationController implements IController{

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

        /** ulozi si data z formulare pro registraci*/
        if(isset($_POST['action']) and $_POST['action'] == "registration_but"){

          $login = htmlspecialchars($_POST['login']);
          $password = htmlspecialchars($_POST['password']);
          $password_repeat = htmlspecialchars($_POST['password_repeat']);

          /** kontroluje stejnost hesel a ulozi si uzivatele do databaze */
          if($password == $password_repeat){
            $password = password_hash($password, PASSWORD_BCRYPT);
              $result = $this->us->db->addNewUser($login, $password);

              /** načte vyskakovací zprávy s prislusnymi chybovimi hlasenimi*/
              if($result){
                $tplData["success_text_registration"] = "Váš účet byl vytvořen";
              }else{
                $tplData["failure_text_registration"] = "Toto uživatelské jméno je už zabrané";
              }

          }else{
            $tplData["failure_text_registration"] = "Musíš zadat stejná hesla";
          }
        }

        ob_start();

        require_once(DIRECTORY_VIEWS . "/UserRegistrationTemplate.tpl.php");

        return ob_get_clean();
    }

}
 ?>
