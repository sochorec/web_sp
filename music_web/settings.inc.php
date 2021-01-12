<?php
/************  nastaveni aplikace ************/

/** Adresa serveru.*/
define("DB_SERVER","localhost"); // https://students.kiv.zcu.cz lze 147.228.63.10, ale musite byt na VPN
/* Nazev databaze. */
define("DB_NAME","music_db");
/** Uzivatel databaze. */
define("DB_USER","root");
/** Heslo uzivatele databaze */
define("DB_PASS","");

/** Tabulky */
define("TABLE_PERMISSION", "permission");
define("TABLE_REVIEW", "review");
define("TABLE_SONG", "song");
define("TABLE_USER", "user");



/** Adresar kontroleru. */
const DIRECTORY_CONTROLLERS = "app/Controllers";
/** Adresar modelu. */
const DIRECTORY_MODELS = "app/Models";
/** Adresar sablon */
const DIRECTORY_VIEWS = "app/Views";

/** Klic defaultni webove stranky. */
const DEFAULT_WEB_PAGE_KEY = "uvod";

/** Schovane hodnoceni. */
const REVIEW_HIDDEN = "je_schovana";

/** bez hodnoceni. */
const NO_REVIEW = "bez_hodnoceni";

/** Dostupne webove stranky. */
const WEB_PAGES = array(

      /** uvodni stranka */
    "uvod" => array(
        "title" => "Úvodní stránka",

        /** kontroler */
        "file_name" => "IntroductionController.class.php",
        "class_name" => "IntroductionController"
    ),
    /** sprava uzivatelu */
    "sprava_roli" => array(
        "title" => "Správa uživatelů",

        /** kontroler */
        "file_name" => "UserRoleManagementController.class.php",
        "class_name" => "UserRoleManagementController"
    ),
    /** registrace */
    "registrace" => array(
        "title" => "Registrace uživatele",

        /** kontroler */
        "file_name" => "UserRegistrationController.class.php",
        "class_name" => "UserRegistrationController"
    ),
    /** přihlášení */
    "prihlaseni" => array(
        "title" => "Přihlášení uživatele",

        /** kontroler */
        "file_name" => "UserLoginController.class.php",
        "class_name" => "UserLoginController"
    ),
    /** odhlášení */
    "odhlaseni" => array(
        "title" => "Odhlášení uživatele",

        /** kontroler */
        "file_name" => "UserLogoutController.class.php",
        "class_name" => "UserLogoutController"
    ),
    /** seznam skladeb */
    "seznam_skladeb" => array(
        "title" => "Seznam skladeb",

        /** kontroler */
        "file_name" => "SongListController.class.php",
        "class_name" => "SongListController"
    ),
    /** stranka skladby */
    "skladba" => array(
        "title" => "Skladba",

        /** kontroler */
        "file_name" => "SongPageController.class.php",
        "class_name" => "SongPageController"
    ),
    /** přidání skladeb */
    "pridani_skladeb" => array(
        "title" => "Přidání Skladby",

        /** kontroler */
        "file_name" => "SongAddController.class.php",
        "class_name" => "SongAddController"
    ),
    /** hodnocení skladby */
    "hodnoceni" => array(
        "title" => "Hodnoceni skladby",

        /** kontroler */
        "file_name" => "SongReviewController.class.php",
        "class_name" => "SongReviewController"
    ),
    /** moje hodnocení skladby */
    "moje_hodnoceni" => array(
        "title" => "Hodnoceni skladby",

        /** kontroler */
        "file_name" => "MySongReviewController.class.php",
        "class_name" => "MySongReviewController"
    ),

);

?>
