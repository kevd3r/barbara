<?php
require_once __DIR__ . "/lib/config.php";
require_once __DIR__ . "/lib/pdo.php";
require_once __DIR__ . '/lib/event.php';
require_once __DIR__ . '/lib/menu.php';
// on va gérer les cas d'erreur, notamment dans l'url
$mainMenu["evenement.php"] = ["title" => "Evènement introuvable", "head_title" => "Evènement Introuvable", "meta_description" => "Evènement Introuvable", "exclude" => true];

$error = false;
if (isset($_GET["id"])) {
  //  on récupère l'id de l'évènement en question
  $id = $_GET["id"];
  // on fait un appel à la base de données par la fonction
  $event = getEventById($pdo, $id);
  if ($event) {
    $imagePath = getEventImage($event['image']);
    $mainMenu["evenement.php"] = ["title" => htmlentities($event["title"]), "head_title" => htmlentities($event['title']), "meta_description" => htmlentities(substr($event["content"], 0, 250)), "exclude" => true];
  } else {
    $error = true;
  }
} else {
  $error = true;
}
// là on inclue les éléments de menu 
require_once __DIR__ . '/templates/header.php';
// on appelle le genre du stage
$gender = getGender($pdo, $event);
// on appelle la catégorie du stage
$category = getCategory($pdo, $event);
$startDate = date("d-m-Y", strtotime($event['date_debut']));
$endDate = date("d-m-Y", strtotime($event['date_fin']));
?>

<?php if (!$error) { ?>

  <div class="container col-xxl-8 px-4 py-5">
    <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
      <div class="col-10 col-sm-8 col-lg-6">
        <img src="<?= $imagePath ?>" class="d-block mx-lg-auto img-fluid" alt="<?= htmlentities($event['title']) ?>" width="700" height="500" loading="lazy">
      </div>
      <div class="col-lg-6">
        <h3 class="event head-title"><?= htmlentities($category['name']); ?></h3>
        <h2 class="display-5 fw-bold text-body-emphasis lh-1 mb-3 event-title capitalize">
          <?= htmlentities($event['title']) ?>
        </h2>
        <h5>Stage <?= htmlentities(" " . $gender['name']) ?></h5>
        <h5>Du <?= htmlentities(" " . $startDate . " ") ?> Au <?= htmlentities(" " . $endDate . " ") ?></h5>
        <h6 class="card-title"><?= htmlentities($event["location"]) ?></h6>
        <p class="lead"><?= htmlentities($event["content"]) ?></p>
        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
          <a href="/evenements.php" class="btn btn-primary btn-lg px-4 me-md-2">Evénements</a>
          <a href="/index.php" class="btn btn-primary btn-lg px-4">Accueil</a>
        </div>
      </div>
    </div>
  </div>
<?php } else { ?>
  <h1>Evènement introuvable</h1>
<?php } ?>

<?php
require_once __DIR__ . '/templates/footer.php';
?>
