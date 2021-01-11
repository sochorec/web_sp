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
 <h1>Recenze skladby</h1>
   <div class="card-deck mb-3">
     <div class="card bg-light">
       <div class="card-body text-left">
         <h2 class="card-text"> <?php echo $tplData['name']; ?> </h2>
         <p class="card-text">Interpret: <?php echo $tplData['interpret']; ?></p>
         <p class="card-text">Délka: <?php echo $tplData['lenght']; ?></p>
         <p class="card-text">Rok vydání: <?php echo $tplData['year']; ?></p>
         <p class="card-text">Průměrné hodnocení: <?php echo $tplData['avrg_rating']; ?></p>
       </div>
     </div>
   </div>
 </div>

<!--  karta pro zobrazení hodnocení  -->
 <?php foreach ($tplData['songReviewData'] as $review) { ?>
 <div class="container col-md-5">
    <div class="card-deck mb-3">
      <div class="card bg-light">
        <div class="card-body text-left">
          <p class="card-text">od <?php echo $review['review_name']; ?></p>
          <p class="card-text">Hodnoceni: <?php echo $review['rating']; ?></p>
          <p class="card-text"><?php echo $review['review_text']; ?></p>
        </div>
      </div>
    </div>
  </div>

  <?php }

/** výpis patičky */
$tplBasic->getHTMLFooter();

?>
