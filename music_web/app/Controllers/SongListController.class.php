<?php
require_once(DIRECTORY_CONTROLLERS ."/IController.interface.php");

/**
* Kontroler pro stranku s uvodem
* @author                 Matěj Sochorec
*/
class SongListController implements IController{

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

    /** ulozi si data vsech skladeb*/
    $allSongs = $this->us->db->getAllSongs();
    for($i = 0; $i < count($allSongs); $i++){

      $song_id = $allSongs[$i]['id_song'];

      $song_reviews = $this->us->db->getReviewsFromSong($song_id);

      /** vypocita prumer hodnoceni*/
      $rating_sum = 0;
      for($j = 0; $j < count($song_reviews); $j++){
        $rating_sum = $rating_sum + $song_reviews[$j]['rating'];
      }
      $num_of_reviews = count($song_reviews);

      if($num_of_reviews != 0){
      $avrg_rating = $rating_sum / count($song_reviews);
      }else{
        $avrg_rating = 0;
      }

      /** nastavi si vypocitana data*/
      $allSongs[$i]['song_reviews'] = $song_reviews;
      $allSongs[$i]['avrg_rating'] = $avrg_rating;
      $allSongs[$i]['number_of_reviews'] = $num_of_reviews;
    }

    $tplData['songData'] = $allSongs;


    ob_start();

    require_once(DIRECTORY_VIEWS . "/SongListTemplate.tpl.php");

    return ob_get_clean();
  }

}
?>
