<?php
require_once(DIRECTORY_CONTROLLERS ."/IController.interface.php");

/**
* Kontroler pro stranku s uvodem
* @author                 Matěj Sochorec
*/
class MySongReviewController implements IController{

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

        /** ziska id uzivatele z url a ulolzi si jeho informace*/
        if(isset($_GET['uzivatel_id'])){
          $user_id =  $_GET['uzivatel_id'];
          $user = $this->us->db->getUserDataById($user_id);
          $tplData['user_page_name'] = $user['name'];
          $tplData['user_name'] = $user['name'];
          $tplData['role_name'] = $user['permission'];
          $user_reviews = $this->us->db->getReviewsFromUser($user_id);

          /** ziska jmeno uzivatele z id skladby */
          foreach ($song_reviews as &$review) {
            $song = $this->us->db->getSongById($review['id_song']);
            $review['review_name'] = $song[0]['name'];
          }

          unset($review);

          $tplData['songReviewData'] = $song_reviews;

        }else{

        }

        ob_start();

        require_once(DIRECTORY_VIEWS ."/MyReviewTemplate.tpl.php");

        return ob_get_clean();
    }

}
 ?>
