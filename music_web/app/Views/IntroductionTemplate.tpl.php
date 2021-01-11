<?php
/** šablona*/
global $tplData;

/**  připojení objektu pro výpis základní šablony */
require(DIRECTORY_VIEWS ."/BaseTemplate.class.php");
$tplBasic = new BaseTemplate();

/** výpis hlavičky */
$tplBasic->getHTMLHeader($tplData['title'], $tplData['username'], $tplData['permission']);
?>
<article class="container">
  <div class="row">
    <h1>Vítejte</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    <p>Massa ultricies mi quis hendrerit dolor magna eget. Pharetra et ultrices neque ornare aenean euismod elementum nisi quis. Nulla aliquet porttitor lacus luctus. Arcu bibendum at varius vel pharetra. Condimentum lacinia quis vel eros. Platea dictumst quisque sagittis purus. Praesent elementum facilisis leo vel fringilla est ullamcorper eget nulla. Ipsum a arcu cursus vitae congue. A lacus vestibulum sed arcu. Amet mauris commodo quis imperdiet massa. Diam quis enim lobortis scelerisque fermentum dui. In arcu cursus euismod quis. Risus commodo viverra maecenas accumsan lacus. Duis ut diam quam nulla porttitor massa id neque aliquam. Egestas erat imperdiet sed euismod nisi porta lorem mollis. Egestas egestas fringilla phasellus faucibus scelerisque eleifend donec.</p>
    <h1>Poslední přidané skladby:</h1>
  </div>
  <div class="row">

    </article>

    <!--  karta pro zobrazení skladby  -->
    <div class="container col-md-6">
     <?php foreach ($tplData['songData'] as $song) { ?>
       <div class="card-deck mb-3">
         <div class="card bg-light">
           <div class="card-body text-left">
             <h2 class="card-text"> <?php echo $song['name']; ?> </h2>
             <p class="card-text">Interpret: <?php echo $song['interpret']; ?></p>
             <p class="card-text">Délka: <?php echo $song['lenght']; ?></p>
             <p class="card-text">Rok vydání: <?php echo $song['year']; ?></p>
             <p class="card-text">Průměrné hodnocení: <?php echo $song['avrg_rating']; ?></p>
             <?php if($song['number_of_reviews'] == 0){ ?>
             <p class="card-text">Tato skladba nemá žádná hodnocení</p>
             <?php
           }else{
             ?>
             <a href="index.php?page=skladba&skladba_id=<?php echo $song['id_song']; ?>"> Hodnocení ( <?php echo $song['number_of_reviews']; ?> ) </a>
           <?php
            }
              if($tplData['permission'] >= 1) { ?>
              <a class="btn btn-link" href="index.php?page=hodnoceni&skladba_id=<?php echo $song['id_song']; ?>"> Ohodnotit tuto skladbu</a>
              <?php } ?>
           </div>

           </div>
         </div>
     <?php } ?>
   </div>





<?php

/** výpis patičky */
$tplBasic->getHTMLFooter();

?>
