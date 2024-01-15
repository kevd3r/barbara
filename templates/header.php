<?php
require_once __DIR__ . '/../lib/config.php';
require_once __DIR__ . '/../lib/session.php';
// on va récupérer ce qui se passe dans l'URL : on pourrait avec $_GET, on va le faire avec $_SERVER

$currentPage = basename($_SERVER["SCRIPT_NAME"]);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="<?= $mainMenu[$currentPage]["meta_description"] ?>">
  <link rel="shortcut icon" href="./assets/components/favico.png" type="image/x-icon">
  <link rel="stylesheet" href="./node_modules/bootstrap-icons/font/bootstrap-icons.css">
  <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.css">
  <link rel="stylesheet" href="./style/style.css">
  <title><?= $mainMenu[$currentPage]["head_title"] ?></title>
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-xl navbar-dark bg-none p-1  col-xxl-10 m-auto border-bottom" aria-label="Fifth navbar example">
      <div class="container-fluid ">
        <a href="./index.php"><img src="./assets/components/logo_def.png" alt="logo" id="logo"></a>
        <div class="title ps-sm-3 pt-2">
          <h1>Barbara Jost</h1>
          <h2>Psychologue</h2>
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse mt-2" id="navbarsExample05">
          <ul class="navbar-nav nav-pills mb-2 mb-lg-0 list-ul ms-lg-auto">


            <?php foreach ($mainMenu as $key => $menuItem) {
              if (!array_key_exists("exclude", $menuItem)) { ?>
                <li class="nav-item">
                  <a class="nav-link text-end px-2 <?php echo ($key === $currentPage) ? "active" : "" ?>" aria-current="page" href="<?= $key ?>"><?= $menuItem["title"] ?></a>
                </li>

            <?php }
            } ?>

          </ul>
          <div class="col-md-3 text-end">
            <?php if (isset($_SESSION['user'])) { ?>
              <a href="./logout.php" class="php btn btn-primary">Déconnexion</a>
            <?php } ?>
          </div>
        </div>
      </div>
    </nav>
  </header>

  <main class="main">