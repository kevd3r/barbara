<?php
require_once __DIR__ . '/lib/config.php';
require_once __DIR__ . '/lib/pdo.php';
require_once __DIR__ . '/lib/menu.php';
require_once __DIR__ . '/templates/header.php';
require_once __DIR__ . '/lib/event.php';


$events = getEvents($pdo,_HOME_EVENTS_LIMIT_);

?>

<div class="container col-xxl-8 px-4 py-5">
  <div class="row flex-lg-row-reverse align-items-center g-5 py-md-5">
    <div class="col-10 col-sm-8 col-lg-6 m-0 d-none d-md-flex">
      <img src="./assets/components/logo_def.png" class="big-logo d-block mx-lg-auto img-fluid m-auto" alt="logo big" width="700" height="500" loading="lazy">
    </div>
    <div class="col-lg-6">
      <h2 class="title-main-page display-5 fw-bold text-body-emphasis lh-1 mb-3">J'ose être qui je suis !</h2>
      <p class="lead">Tantra ou tentera pas ?</p>
      <p class="course">
        Thérapie brève, individuelle ou de couple, stage, voyage initiatique,... Les supports sont
        nombreux et vous trouverez celui qui vous convient pour vous déployer. Les points communs
        entre toutes ces prises
        en charge sont : la bienveillance, le partage, la joie et la bonne humeur.
      </p>
      <div class="d-grid gap-2 d-md-flex justify-content-md-start">
        <a href="./evenements.php" aria-label="learn much about the events i organize" class="btn btn-primary btn-lg px-4 me-md-2">Découvrir</a>
      </div>
    </div>
  </div>

  <div class="row text-center">
    <?php foreach ($events as $key => $event) {
      require __DIR__."/templates/event_part.php";
  } ?>

  </div>

  <?php
  require_once __DIR__ . '/templates/footer.php';
  ?>
