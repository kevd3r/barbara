<?php
require_once __DIR__ . '/../../lib/config.php';
require_once __DIR__ . '/../../lib/session.php';

adminOnly();
$adminMenu = [
  'index.php' => [
    "title"=>"Accueil",
    "icon" =>"bi bi-house"
  ],
  'evenements.php' =>[
    "title"=>"Evènements",
    "icon"=>"bi bi-speedometer2" 
  ],
  'article.php'=>
  [
    "title"=>'Ajouter un évènement',
    "icon"=>"bi bi-table"
  ],
  'event_delete.php'=>
  [
    'title'=>"Supprimer un évènement",
    "icon"=>"bi bi-trash"
  ]
  ];
$currentPage = basename($_SERVER['SCRIPT_NAME']);


?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="../../assets/components/favico.png" type="image/x-icon">
  <link rel="stylesheet" href="../../node_modules/bootstrap-icons/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.css">
  <link rel="stylesheet" href="../../style/style.css">
  <title>Barbara Jost</title>
</head>

<body>
  <div class="admin container d-flex m-0 p-0">
    <div class="admin-sidebar d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 280px;">

      <a href="index.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <img src="../assets/components/logo_def.png" alt="logo Barbara Jost" class="admin-logo">
        <span class="fs-4">Administration</span>
      </a>
      <hr>

      <ul class="nav nav-pills flex-column mb-auto">
        <?php foreach ($adminMenu as $key => $menuItem) { ?>
          <li class="nav-item">
            <a href="<?= $key ?>" class="nav-link <?php echo(basename($key === $currentPage))?"active":""?>" aria-current="page">
              <i class="<?=$menuItem['icon']; ?> pe-none me-2"></i>
              <?= $menuItem['title'] ?>
            </a>
          </li>
        <?php } ?>

      </ul>
      <hr>
      <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" 
          data-bs-toggle="dropdown" aria-expanded="false">
          <img src="/assets//images/admin_image.jpg" alt="admin portrait" 
            width="32" height="32" class="rounded-circle me-2">
          <strong><?= $_SESSION['user']['first_name']?></strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
          <li><a class="dropdown-item" href="/logout.php">Déconnexion</a></li>
        </ul>
      </div>
    </div>

    <main class="d-flex flex-column px-4">