<?php

/**
 * Trida vypisujici HTML hlavicku a paticku stranky.
 */
class BaseTemplate{

    /**
     *  Vrati vrsek stranky az po oblast, ve ktere se vypisuje obsah stranky.
     *  @param string $pageTitle    Nazev stranky.
     *  @param string $userName    uživatelské jméno.
     *  @param int  $permissionWeight    váha uživatele.
     */
    public function getHTMLHeader(string $pageTitle, string $userName = "" , int $permissionWeight = 0) {
        ?>

        <!doctype html>
        <html>
            <head>

                <!-- nastavení kódování -->
                <meta charset='utf-8'>
                <!-- nastavení viewportu -->
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <meta name="keywords" content="Hudba, Hodnocení hudby, Hodnocení písní">
                <meta name="description" content="Portál pro hodnocení hudby">
                <meta name="author" content="Matěj Sochorec">

                <!-- název -->

                <title><?php echo $pageTitle; ?></title>

                <!-- mé vlastní CSS -->
                <!--<link rel="stylesheet" href="myStyles.css">-->

                <!-- CSS pro Bootstrap -->
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

                <!-- Font Awesome -->
                <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
            </head>
            <body>

              <!-- navigační menu -->
              <nav class="navbar py-4 bg-success text-white navbar-dark navbar-expand-md sticky-top">
                  <div class="container">
                      <!-- Brand -->
                      <a class="navbar-brand" href="index.php?page=uvod">
                          <i class="fas fa-headphones-alt"></i>
                          Portál pro hodnocení hudby
                      </a>

                      <!-- Toggler/collapsibe Button -->
                      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                          <span class="navbar-toggler-icon"></span>
                      </button>

                      <!-- Navbar links -->
                      <div class="collapse navbar-collapse" id="collapsibleNavbar">

                          <ul class="navbar-nav">
                              <li class="nav-item">
                                <a class="nav-link" href="index.php?page=seznam_skladeb">Seznam skladeb</a>
                              </li>
                               <?php if($permissionWeight >= 2) { ?>
                               <li class="nav-item">
                                  <a class="nav-link" href="index.php?page=pridani_skladeb">Přidat skladbu</a>
                              </li>
                              <?php } ?>
                              <?php if($permissionWeight >= 3) { ?>
                              <li class="nav-item">
                                  <a class="nav-link" href="index.php?page=sprava_roli">Správa rolí uživatelů</a>
                              </li>
                              <?php } ?>

                          </ul>
                          <ul class="navbar-nav ml-auto">
                            <?php if($permissionWeight <= 0) { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?page=prihlaseni">Přihlášení</a>
                            </li>
                          <?php }else { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?page=odhlaseni">Odhlášení uživatele: <?php echo $userName; ?></a>
                            </li>
                          <?php } ?>
                          </ul>
                      </div>
                  </div>
              </nav>
        <?php
    }

    /**
     *  Vrati paticku stranky.
     */
    public function getHTMLFooter(){
        ?>
                <br><br><br><br>
                <footer class="bg-success container-fluid py-4 fixed-bottom text-white text-center font-weight-bold">
                  <div class="container">
                    (c) Matěj Sochorec 2020
                  </div>
                </footer>

                <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
            <body>
        </html>

        <?php
    }

    /** vrátí modré upozornění*/
    public function getBlueAlert(string $text){
      ?>
        <div class="cantainer mt-2">
          <div class="alert alert-primary " role="alert">
            <?php echo $text ?>
          </div>
        </div>
      <?php
    }

    /** vrátí červené upozornění*/
    public function getRedAlert(string $text){
      ?>
        <div class="cantainer mt-2">
          <div class="alert alert-danger" role="alert">
            <?php echo $text ?>
          </div>
        </div>
      <?php
    }

}

?>
