<?php
//////////////////////////////////////////////////////////////
////////////// Vlastni trida pro praci s databazi ////////////////
//////////////////////////////////////////////////////////////

/**
 * Vlastni trida spravujici databazi.
 */
class MyDatabase {

  /** @var PDO $pdo  PDO objekt pro praci s databazi. */
  private $pdo;

  /**
   * MyDatabase constructor.
   * Inicializace pripojeni k databazi a pokud ma byt spravovano prihlaseni uzivatele,
   * tak i vlastni objekt pro spravu session.
   * Pozn.: v samostatne praci by sprava prihlaseni uzivatele mela byt v samostatne tride.
   * Pozn.2: take je mozne do samostatne tridy vytahnout konkretni funkce pro praci s databazi.
   */
  public function __construct(){
    /** inicialilzuju pripojeni k databazi - informace beru ze settings */
    $this->pdo = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_NAME, DB_USER, DB_PASS);
    $this->pdo->exec("set names utf8");
  }

/************ manipulace s právy ************/

    /**
    * vrati pole vsech povoleni
    *
    * @return array      pole se vsemi pravy
    */
  public function getAllPermissions(){
    $query = " SELECT * FROM " . TABLE_PERMISSION . " ORDER BY weight ASC ;";
    $result = $this->pdo->prepare($query);
    if($result->execute()) {
      return $result->fetchAll();
    }else{
      return [];
    }
  }

  /**
   * vrati pole podle sveho id
   *
   * @param int $permission_id    id povoleni
   * @return array                pole s prislusnymi pravy
   */
  public function getPermissionDataById(int $permission_id){
    $query = " SELECT * FROM " . TABLE_PERMISSION . " WHERE id_permission=:id_permission ;" ;
    $result = $this->pdo->prepare($query);
    $result->bindValue(":id_permission",$permission_id, PDO::PARAM_INT);

    if($result->execute()) {
      $permission = $result->fetchAll();
      return $permission[0];
    }else{
      return null;
    }
  }




/************ manipulace s uživateli ************/

  /**
   * Vytvori noveho uzivatele v databazi
   *
   * @param string $login       prihlasovaci jmeno
   * @param string $password    heslo
   * @param int $permission_id  cizi klic tabulky s pravy
   * @return array               Vlozen v poradku?
   */
  public function addNewUser(string $login, string $password, int $permission_id = 3){

      $query = " SELECT * FROM " . TABLE_USER . " WHERE login=:login ;";
      $result = $this->pdo->prepare($query);
      $result->bindValue(":login",$login);

      if($result->execute()) {
        $user = $result->fetchAll();
      }else{
        $user = [];
    }


      if(!count($user)){
        $query = "INSERT INTO " . TABLE_USER . " (login, password, id_permission) VALUES (:login, :password, :id_permission);";
        $result = $this->pdo->prepare($query);
        $result->bindValue(":login", $login);
        $result->bindValue(":password", $password);
        $result->bindValue(":id_permission", $permission_id, PDO::PARAM_INT);

        $result->execute();
        return true;
      }else{
         return false;
      }
  }

  /**
   * vymaze uzivatele z databaze
   *
   * @param string $user_id     id uzivatele
   * @return bool               uspesne odebran?
   */
  public function deleteUser(int $user_id){
        $query = " DELETE FROM " . TABLE_USER . " WHERE id_user=:id_user;";
        $result = $this->pdo->prepare($query);
        $result->bindValue(":id_user",$user_id, PDO::PARAM_INT);

        if($result->execute()) {
          return true;
        }else{
          return false;
        }
  }

  /**
   * vrati pole se vsemi uzivatelemi
   *
   * @return array              pole se vsemi uzivateli
   */
  public function getAllUsers(){
    $query = " SELECT * FROM " . TABLE_USER . " ORDER BY id_user ASC ;";
    $result = $this->pdo->prepare($query);

    if($result->execute()) {
      return $result->fetchAll();
    }else{
      return [];
    }
  }

  /**
   * vrati uzivatele z databaze podle id
   *
   * @param string $user_id     id uzivatele
   * @return array              pole s vybranym uzivatelem
   */
  public function getUserDataById(int $user_id){
    $query = " SELECT * FROM " . TABLE_USER . " WHERE id_user=:id_user ;";
    $result = $this->pdo->prepare($query);
    $result->bindValue(":id_user",$user_id, PDO::PARAM_INT);

    if($result->execute()) {
      return $result->fetchAll();
    }else{
      return [];
    }
  }

  /**
   * vrati uzivatele z databaze podle loginu
   *
   * @param string $login       prihlasovaci jmeno uzivatele uzivatele
   * @return array              pole s vybranym uzivatelem
   */
  public function getUserByLogin(string $login){
    $query = " SELECT * FROM " . TABLE_USER . " WHERE login=:login ;";
    $result = $this->pdo->prepare($query);
    $result->bindValue(":login",$login);

    if($result->execute()) {
      return $result->fetchAll();
    }else{
      return [];
    }
  }

  /**
   * nastavi uzivateli povoleni
   *
   * @param int $user_id          id uzivatele
   * @param int $permission_id    id povoleni
   * @return bool                 uspesne nastavno?
   */
  public function setUserPermission(int $user_id, int $permission_id){
    $query = " UPDATE " . TABLE_USER . " SET id_permission=:id_permission WHERE id_user=:id_user ;";
    $result = $this->pdo->prepare($query);
    $result->bindValue(":id_user",$user_id, PDO::PARAM_INT);
    $result->bindValue(":id_permission",$permission_id, PDO::PARAM_INT);

    if($result->execute()) {
      return true;
    }else{
      return false;
    }

  }

  /**
   * vrati uzivatele z databaze podle loginu
   *
   * @param string $song_id     id skladby
   * @return array              pole se vsemi hodnocenimi specifick skladby
   */
  public function getReviewsFromUser($user_id){
    $query = " SELECT * FROM " . TABLE_REVIEW . " WHERE id_user=:id_user;";
    $result = $this->pdo->prepare($query);
    $result->bindValue(":id_user",$user_id, PDO::PARAM_INT);

    if($result->execute()) {
      return $result->fetchAll();
    }else{
      return [];
    }
  }

/************ manipulace s hodnocením ************/

/**
 * prida nove hodnoceni
 *
 * @param int $rating           hodnoceni
 * @param string $review_text   recenze
 * @param int $hidden           je schovany
 * @param int $user_id          id uzivatele
 * @param int $song_id          id skladby
 * @return bool                 uspesne pridan?
 */
public function addNewReview(int $rating, string $review_text, int $user_id, int $song_id, int $hidden = 0){

    $query = " INSERT INTO " . TABLE_REVIEW . " (rating, review_text, hidden, id_user, id_song) VALUES (:rating, :review_text, :hidden, :id_user, :id_song);";
    $result = $this->pdo->prepare($query);
    $result->bindValue(":rating",$rating, PDO::PARAM_INT);
    $result->bindValue(":review_text",$review_text);
    $result->bindValue(":hidden",$hidden);
    $result->bindValue(":id_user",$user_id);
    $result->bindValue(":id_song",$song_id);

    if($result->execute()) {
      return true;
    }else{
      return false;
    }

}

/**
 * nastavi uzivateli povoleni
 *
 * @return array                pole se vsemi hodnocenimi
 */
public function getAllReviews(){
  $query = " SELECT * FROM " . TABLE_REVIEW . ";";
  $result = $this->pdo->prepare($query);

  if($result->execute()) {
    return $result->fetchAll();
  }else{
    return [];
  }
}

/**
 * vrati uzivatele z databaze podle loginu
 *
 * @param string $user_id     id uzivatele
 * @return array              pole se vsemi hodnocenimi od specifickeho uzivatele
 */
public function getAllReviewsFromUser(int $user_id){
  $query = " SELECT * FROM " . TABLE_REVIEW . " WHERE id_user=:id_user;";
  $result = $this->pdo->prepare($query);
  $result->bindValue(":id_user",$user_id, PDO::PARAM_INT);

  if($result->execute()) {
    return $result->fetchAll();
  }else{
    return [];
  }
}

/**
 * vrati uzivatele z databaze podle jmena skladby
 *
 * @param string $song_id     id skladby
 * @return array              pole se vsemi hodnocenimi specifick skladby
 */
public function getReviewsFromSong($song_id){
  $query = " SELECT * FROM " . TABLE_REVIEW . " WHERE id_song=:id_song;";
  $result = $this->pdo->prepare($query);
  $result->bindValue(":id_song",$song_id, PDO::PARAM_INT);

  if($result->execute()) {
    return $result->fetchAll();
  }else{
    return [];
  }
}

/************ manipulace se skladbami ************/

/**
 * vrati uzivatele z databaze podle loginu
 *
 * @param string $name        jmeno skladby
 * @param string $interpret   interpret skladby
 * @param string $lenght      delka skladby
 * @param string $year        rok vydani skladby
 * @return bool               uspesne pridan?
 */
public function addNewSong(string $name, string $interpret, int $lenght, int $year){

    $query = " INSERT INTO " . TABLE_SONG . " (name, interpret, lenght, year) VALUES (:name, :interpret, :lenght, :year);";
    $result = $this->pdo->prepare($query);
    $result->bindValue(":name",$name);
    $result->bindValue(":lenght",$lenght, PDO::PARAM_INT);
    $result->bindValue(":year",$year, PDO::PARAM_INT);
    $result->bindValue(":interpret",$interpret);

    if($result->execute()) {
      return true;
    }else{
      return false;
    }

}

/**
 * vrati uzivatele z databaze podle loginu
 *
 * @param string $song_id     id skladby
 * @return bool             uspesne odebran?
 */
public function deleteSong(int $song_id){
      $query = " DELETE FROM " . TABLE_SONG . " WHERE id_song=:id_song;";
      $result = $this->pdo->prepare($query);
      $result->bindValue(":id_song",$song_id, PDO::PARAM_INT);

      if($result->execute()) {
        return true;
      }else{
        return false;
      }
}

/**
 * vrati uzivatele z databaze podle loginu
 *
 * @return array              pole se vsemi skladbami
 */
public function getAllSongs(){
  $query = " SELECT * FROM " . TABLE_SONG . " ORDER BY id_song ASC;";
  $result = $this->pdo->prepare($query);

  if($result->execute()) {
    return $result->fetchAll();
  }else{
    return [];
  }
}

/**
 * vrati uzivatele z databaze podle loginu
 *
 * @param int $number of songs    pocet skladeb pro zobrazeni
 * @return array                  pole s x poslednimi skladbami
 */
public function getLastSongs(int $number_of_songs){
  $query = " SELECT * FROM " . TABLE_SONG . " ORDER BY id_song DESC LIMIT :num_of_songs ;" ;
  $result = $this->pdo->prepare($query);
  $result->bindValue(":num_of_songs",$number_of_songs, PDO::PARAM_INT);

  if($result->execute()) {
    return $result->fetchAll();
  }else{
    return [];
  }
}

/**
 * vrati uzivatele z databaze podle loginu
 *
 * @param string $song_id     id skladby
 * @return array              vrati pole se specifickou skladbou
 */
public function getSongById(int $song_id){
  $query = " SELECT * FROM " . TABLE_SONG . " WHERE id_song=:id_song ;";
  $result = $this->pdo->prepare($query);
  $result->bindValue(":id_song",$song_id, PDO::PARAM_INT);

  if($result->execute()) {
    $song = $result->fetchAll();
    return $song[0];
  }else{
    return null;
  }
}


}
?>
