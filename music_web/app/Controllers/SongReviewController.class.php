<?php
require_once(DIRECTORY_CONTROLLERS ."/IController.interface.php");

/**
* Kontroler pro stranku s uvodem
* @author                 Matěj Sochorec
*/
class SongReviewController implements IController{

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

        /* nastavi jmeno skladby*/
        if(isset($_GET['skladba_id'])){
          $song_id =  $_GET['skladba_id'];
          $song = $this->us->db->getSongById($song_id);
          $tplData['reviewed_song_name'] = $song['name'];
        }

        //** načte si data z formulare pro hodnoceni*/
        if (isset($_POST['action']) and $_POST['action'] == "publish_but") {
          $rating = $_POST['radio'];
          $review = htmlspecialchars($_POST['textarea']);

          $loggedUser = $this->us->getLoggedUserData();
          $user_id = $loggedUser["id_user"];


          /** načte vyskakovací zprávy s prislusnymi chybovimi hlasenimi a ulozi vysledek*/
          $result = $this->us->db->addNewReview($rating, $review, $user_id, $song_id);

          if($result){
            $tplData["success_text_review"] = "Hodnocení bylo úspěšně přidáno";
          }else{
            $user_reviews = $this->us->db->getAllReviewsFromUser($user_id);

            $tplData["failure_text_review"] = "Hodnocení se nepodařilo přidat";
          }

        }



        ob_start();

        require_once(DIRECTORY_VIEWS . "/SongReviewTemplate.tpl.php");

        return ob_get_clean();
    }

}
 ?>
