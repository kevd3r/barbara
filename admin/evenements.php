<?php
require_once __DIR__ . '/../lib/config.php';
require_once __DIR__ . '/../lib/pdo.php';
require_once __DIR__ . '/templates/header.php';
require_once __DIR__ . '/../lib/event.php';


if (isset($_GET['page'])) {
  $page = (int)$_GET['page'];
} else {
  $page = 1;
}
$todayDate = date("Y-m-d");

$events = getAllEvents($pdo, _ADMIN_ITEMS_PER_PAGE_, $page);
$totalEvents = getTotalEvents($pdo);
$totalPages = ceil($totalEvents / _ADMIN_ITEMS_PER_PAGE_);

?>
<div class="admin-event container">
  <h1 class="display-5 fw-bold text-body-emphasis">Liste des Evènements</h1>
  <div class="d-flex gap-2 justify-content-left py-5">
    <a class="btn btn-primary d-inline-flex align-items-left" href="article.php">
      Ajouter un évènement
    </a>
  </div>
  <table class="table">
    <thead>
      <tr class="table-secondary">
        <th scope="col">Titre</th>
        <th scope="col">Type</th>
        <th scope="col">Pour</th>
        <th scope="col">Débute</th>
        <th scope="col">Finit</th>
        <th scope="col">Lieu</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($events as $event) {
        $gender = getGender($pdo, $event);
        $category = getCategory($pdo, $event);?>

        <tr class="<?php echo($todayDate > $event['date_fin'])? "table-danger":"table-success" ?>">
          <th scope="row"><?= $event['title']; ?></th>
          <td><?= htmlentities($gender['name']); ?></td>
          <td><?= htmlentities($category['name']); ?></td>
          <td><?= htmlentities(formatDate($event['date_debut'])); ?></td>
          <td><?= htmlentities(formatDate($event['date_fin'])); ?></td>
          <td><?= htmlentities($event['location']); ?></td>
          <td><a href="article.php?id=<?= $event['id'] ?>"><i class="bi bi-pencil-square"></i></a>
            <a href="event_delete.php?id=<?= $event['id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')"><i class="bi bi-trash"></i></a>
          </td>
        </tr>      
      <?php } ?>
    </tbody>
  </table>
  <?php if ($totalPages > 1) { ?>
    <nav aria-label="Page navigation">
      <ul class="pagination">
        <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
          <li class="page-item"><a class="page-link <?php echo ($page == $i) ? "active" : ""; ?>" href="?page=<?= $i ?>"><?= $i ?></a></li>

        <?php } ?>
      </ul>
    </nav>

  <?php } ?>
</div>


<?php
require_once __DIR__ . '/templates/footer.php';
?>
