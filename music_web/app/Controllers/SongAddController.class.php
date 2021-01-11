<?php
require_once(DIRECTORY_CONTROLLERS ."/IController.interface.php");

/**
* Kontroler pro stranku s uvodem
* @author                 Matěj Sochorec
*/
class SongAddController implements IController{

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

        /** ulozi si data z formulare pro vytvareni skladby*/
        if(isset($_POST['action']) and $_POST['action'] == "add_song_but"){

          $song_name = htmlspecialchars($_POST['song_name']);
          $song_interpret = htmlspecialchars($_POST['interpret']);
          $song_lenght = htmlspecialchars($_POST['lenght']);
          $song_debut = htmlspecialchars($_POST['debut_year']);


          $result = $this->us->db->addNewSong($song_name, $song_interpret, $song_lenght, $song_debut);
          /** načte vyskakovací zprávy s prislusnymi chybovimi hlasenimi*/
          if($result){
            $tplData["success_song_add"] = "Skladba byla úspěšně přidána";
          }else{
            $tplData["failure_song_add"] = "Přidání skladby selhalo";
          }

        }

        ob_start();

        require_once(DIRECTORY_VIEWS . "/SongAddTemplate.tpl.php");

        return ob_get_clean();
    }

}
 ?>
