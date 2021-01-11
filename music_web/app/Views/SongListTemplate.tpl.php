<?php
 /** šablona*/
global $tplData;

/**  připojení objektu pro výpis základní šablony */
require(DIRECTORY_VIEWS ."/BaseTemplate.class.php");
$tplBasic = new BaseTemplate();

/** výpis hlavičky */
$tplBasic->getHTMLHeader($tplData['title'], $tplData['username'], $tplData['permission']);
?>
<!--  karta pro zobrazení skladby  -->
<div class="container col-md-5">
 <h1>Seznam skladeb</h1>
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
