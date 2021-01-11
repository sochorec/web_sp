<?php
require_once(DIRECTORY_CONTROLLERS ."/IController.interface.php");

/**
* Kontroler pro stranku s uvodem
* @author                 Matěj Sochorec
*/
class SongPageController implements IController{

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

        /** nastavi informace o skladbe*/
        if(isset($_GET['skladba_id'])){
          $song_id =  $_GET['skladba_id'];
          $song = $this->us->db->getSongById($song_id);
          $tplData['song_page_name'] = $song['name'];
          $tplData['name'] = $song['name'];
          $tplData['interpret'] = $song['interpret'];
          $tplData['lenght'] = $song['lenght'];
          $tplData['year'] = $song['year'];
          $song_reviews = $this->us->db->getReviewsFromSong($song_id);

          /** vypocet prumeru hodnoceni*/
          $rating_sum = 0;
          for($j = 0; $j < count($song_reviews); $j++){
            $rating_sum = $rating_sum + $song_reviews[$j]['rating'];
          }
          $avrg_rating = $rating_sum / count($song_reviews);
          $tplData['avrg_rating'] = $avrg_rating;

          /** ulozi si data pro hodnoceni*/
          foreach ($song_reviews as &$review) {
            $user = $this->us->db->getUserDataById($review['id_user']);
            $review['review_name'] = $user[0]['login'];
            $review['review_user_id'] = $user[0]['id_user'];
          }

          unset($review);

          $tplData['songReviewData'] = $song_reviews;

        }


        ob_start();

        require_once(DIRECTORY_VIEWS . "/SongPageTemplate.tpl.php");

        return ob_get_clean();
    }

}
 ?>
