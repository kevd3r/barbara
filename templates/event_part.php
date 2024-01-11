<?php
$imagePath = getEventImage($event['image']);
$gender = getGender($pdo, $event);
$category = getCategory($pdo, $event);
$startDate = date("d-m-Y", strtotime($event['date_debut']));
$endDate = date("d-m-Y", strtotime($event['date_fin']));
?>


<div class="col-md-6 col-lg-4 py-2">
  <div class="card">
    <img src="<?= $imagePath ?>" class="card-img-top" alt="<?= $event['title'] ?>">
    <div class="card-body d-flex">
      <h6 class="head-title"><?= htmlentities($category['name']); ?></h6>
      <h4 class="card-title capitalize"><?= htmlentities($event["title"]) ?></h4>
      <h5 class="card-title">Stage <?= htmlentities(" " . $gender['name']) ?></h5>
      <h6 class="card-title">Du <?= htmlentities(" " . $startDate . " ") ?> Au <?= htmlentities(" " . $endDate . " ")  ?></h6>
      <h6 class="card-title"><?= htmlentities($event["location"]) ?></h6>
      <p class="card-text card-content"><?= htmlentities($event["content"]) ?></p>
      <a href="evenement.php?id=<?= htmlentities($event["id"])  ?>" class="btn btn-primary">Lire la suite</a>
    </div>
  </div>
</div>
