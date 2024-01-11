<?php
require_once __DIR__ .'/lib/config.php';
require_once __DIR__ .'/lib/pdo.php';
require_once __DIR__ .'/lib/menu.php';
require_once __DIR__ .'/templates/header.php';
require_once __DIR__ .'/lib/event.php';

$events = getEvents($pdo);
?>

<h1 class="event text-center my-4 col-10 mx-auto">Evènements à Venir</h1>

<div class="row text-center col-10 m-auto">
  <?php foreach ($events as $key => $event) {
    require __DIR__ . '/templates/event_part.php';
  } ?>

</div>


<?php
require_once __DIR__ . '/templates/footer.php';
?>