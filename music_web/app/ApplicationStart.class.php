<?php

/**
 * Vstupni bod webove aplikace.
 */
class ApplicationStart {

    /** construktor ApplicationStart*/
    public function __construct()
    {
        /** nacteni rozhrani pro controlery*/
        require_once(DIRECTORY_CONTROLLERS . "/IController.interface.php");
    }

    public function appStart(){
        /* test, zda je v URL pozadavku uvedena dostupna stranka, jinak volba defaultni stranky
         mam spravnou hodnotu na vstupu nebo nastavim defaultni */
         if(isset($_GET["page"]) && array_key_exists($_GET["page"], WEB_PAGES)){
             $pageKey = $_GET["page"]; // nastavim pozadovane
        } else {
            $pageKey = DEFAULT_WEB_PAGE_KEY;
        }
        /** pripravim si data ovladace ***/
        $pageInfo = WEB_PAGES[$pageKey];

        /** nacteni odpovidajiciho kontroleru, jeho zavolani a vypsani vysledku */
        /** pripojim souboru ovladace */
        require_once(DIRECTORY_CONTROLLERS ."/". $pageInfo["file_name"]);

        /** nactu ovladac a bez ohledu na prislusnou tridu ho typuju na dane rozhrani */
        /** @var IController $controller  Ovladac prislusne stranky. */
        $controller = new $pageInfo["class_name"];                     //mozna ne cont
        /** zavolam prislusny ovladac a ziskam jeho obsah */
        echo $controller->show($pageInfo["title"]);

    }
}

?>
