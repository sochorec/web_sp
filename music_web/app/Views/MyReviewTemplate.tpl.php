<?php
 /** šablona*/
global $tplData;

/**  připojení objektu pro výpis základní šablony */
require(DIRECTORY_VIEWS ."/BaseTemplate.class.php");
$tplBasic = new BaseTemplate();

/** výpis hlavičky */
$tplBasic->getHTMLHeader($tplData['title'], $tplData['username'], $tplData['permission']);
?>

  <!--  karta pro zobrazení  -->

 <div class="container col-md-5">
  <h1>Recenze skladby</h1>
    <div class="card-deck mb-3">
      <div class="card bg-light">
        <div class="card-body text-left">
          <h2 class="card-text"> <?php echo $tplData['user_name']; ?> </h2>
          <p class="card-text">Role: <?php echo $tplData['role_name']; ?></p>
        </div>
      </div>
    </div>
  </div>

  <!--  karta pro zobrazení hodnoceni  -->

 <?php foreach ($tplData['songReviewData'] as $review) { ?>
 <div class="container col-md-5">
    <div class="card-deck mb-3">
      <div class="card bg-light">
        <div class="card-body text-left">
          <h3 class="card-text">na <?php echo $review['name']; ?></h3>
          <p class="card-text">Hodnoceni: <?php echo $review['rating']; ?></p>
          <p class="card-text"><?php echo $review['review_text']; ?></p>
        </div>
      </div>
    </div>
  </div>

<?php

/** výpis patičky */
$tplBasic->getHTMLFooter();

?>
