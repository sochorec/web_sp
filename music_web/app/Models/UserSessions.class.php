<?php

class UserSessions{

  /** @var MyDatabase $pdo  PDO objekt pro praci s databazi. */
  public $db;

  /** @var string $userSessionKey  Klic pro ulozeni dat uzivatele v session */
  private $userSessionKey = "current_user_id";

  public function __construct(){
      require_once("MyDatabase.class.php");
      /** inicializace objekt sessny **/
      $this->db = new MyDatabase();

      session_start();
  }

  public function login(string $login, string $password){
    $user = $this->db->getUserByLogin($login);
    if(count($user)) {

      $hashed_password = $user[0]['password'];

        if (password_verify($password, $hashed_password)) {
          $_SESSION[$this->userSessionKey] = $user[0]['id_user'];
          return true;
        }
      }else {
        return false;
      }
  }

  /** odebere session pomocí klíče **/
  public function logout(){
    unset($_SESSION[$this->userSessionKey]);
  }

  /** zjiští jestli je nastaven session **/
  public function userLogged(){
    return isset($_SESSION[$this->userSessionKey]);
  }

  /** nastavi informace pouzivane tempolaty**/
  public function setUserTemplateData(){
    global $tplData;

    if($this->userLogged()) {
      $user = $this->getLoggedUserData();
      $tplData["username"] = $user["login"];
      $tplData["permission"] = $this->db->getPermissionDataById($user["id_permission"])['weight'];
    }else {
      $tplData["username"] = "";
      $tplData["permission"] = 0;
    }
  }

  /**
   * Pokud je uzivatel prihlasen, tak vrati jeho data,
   * ale pokud nebyla v session nalezena, tak vypisu chybu.
   *
   * @return mixed|null   Data uzivatele nebo null.
   */
  public function getLoggedUserData(){
      if($this->userLogged()){
          // ziskam data uzivatele ze session
          $user_id = $_SESSION[$this->userSessionKey];
          // pokud nemam data uzivatele, tak vypisu chybu a vynutim odhlaseni uzivatele
          if($user_id == null) {
              // nemam data uzivatele ze session - vypisu jen chybu, uzivatele odhlasim a vratim null
              echo "SEVER ERROR: Data přihlášeného uživatele nebyla nalezena, a proto byl uživatel odhlášen.";
              $this->logout();
              // vracim null
              return null;
          } else {
              // nactu data uzivatele z databaze
              $userData = $this->db->getUserDataById($user_id);
              // mam data uzivatele?
              if(empty($userData)){
                  // nemam - vypisu jen chybu, uzivatele odhlasim a vratim null
                  echo "ERROR: Data přihlášeného uživatele se nenachází v databázi (mohl být smazán), a proto byl uživatel odhlášen.";
                  $this->logout();
                  return null;
              } else {
                  // protoze DB vraci pole uzivatelu, tak vyjmu jeho prvni polozku a vratim ziskana data uzivatele
                  return $userData[0];
              }
          }
      } else {
          // uzivatel neni prihlasen - vracim null
          return null;
      }
  }

}
