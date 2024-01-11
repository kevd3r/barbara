<?php
require_once __DIR__ . '/../lib/config.php';
require_once __DIR__ . '/../lib/session.php';
adminOnly();
require_once __DIR__ . '/../lib/pdo.php';
require_once __DIR__ . '/../lib/event.php';
require_once __DIR__ . '/templates/header.php';

$errors = [];
$messages = [];
$event =
  [
    'title' => '',
    'category_id' => '',
    'gender_id' => '',
    'date_debut' => '',
    'date_fin' => '',
    'location' => '',
    'content' => '',
    'image' => ''
  ];

$categories = getCategories($pdo);
$genders = getGenders($pdo);


if (isset($_GET['id'])) {
  $eventData = getEventById($pdo, $_GET['id']);
  if ($event === false) {
    $errors[] = "L'évènement n'existe pas !";
  } else {
    $event =  array_merge($event,$eventData);
  }
  $pageTitle = "Formulaire modification d'un évènement";
} else {
  $pageTitle = "Formulaire d'ajout d'un événement";
}

// @todo gérer la gestion des erreurs sur les champs (champ vide etc ...)
if (isset($_POST['saveEvent'])) {
  $filename = null;
  // si un fichier est envoyé
  if (isset($_FILES['file']['tmp_name']) && $_FILES['file']['tmp_name'] != '') {
    $checkImage = getimagesize($_FILES['file']['tmp_name']);
    if ($checkImage !== false) {
      $filename = slugify(basename($_FILES['file']['name']));
      $filename = uniqid() . '-' . $filename;
      /* On déplace le fichier uploadé dans notre dossier upload, dirname(__DIR__) 
                permet de cibler le dossier parent car on se trouve dans admin
            */
      if (move_uploaded_file($_FILES['file']['tmp_name'], dirname(__DIR__) . _EVENTS_IMAGES_FOLDER_ . $filename)) {
        if (isset($_POST['image'])) {
          // On supprime l'ancienne image si on a posté une nouvelle
          unlink(dirname(__DIR__) . _EVENTS_IMAGES_FOLDER_ . $_POST['image']);
        }
      } else {
        $errors[] = "Le fichier n'a pas été uploadé !";
      }
    } else {
      $errors[] = "Le fichier doit être une image !";
    }
  } else {
    // Si aucun fichier n'a été envoyé
    if (isset($_GET['id'])) {
      if (isset($_POST['delete_image'])) {
        // Si on a coché la case de suppression d'image, on supprime l'image
        unlink(dirname(__DIR__) . _EVENTS_IMAGES_FOLDER_ . $_POST['image']);
      } else {
        $filename = $_POST['image'];
      }
    }
  }


  $event = [
    'title' => $_POST['title'],
    'category_id' => $_POST['category_id'],
    'gender_id' => $_POST['gender_id'],
    'date_debut' => $_POST['date_debut'],
    'date_fin' => $_POST['date_fin'],
    'location' => $_POST['location'],
    'content' => $_POST['content'],
    'image' => $filename
  ];

  // Si il n'y a pas d'erreur on peut faire la sauvegarde
  if (!$errors){
    if (isset($_GET['id'])){
      // Avec (int) on s'assure que la valeur stockée sera de type int
      $id = (int)$_GET["id"];
    }else{
      $id=null;
    }
    // On passe toutes les données à la fonction saveArticle
    $res = saveArticle(
      $pdo,
      $_POST["title"],
      $_POST["category_id"],
      $_POST["gender_id"],
      $_POST["date_debut"],
      $_POST["date_fin"],
      $_POST["location"],
      $_POST["content"],
      $filename,
      $id);

    if ($res) {
      $messages[] = "L'article a bien été sauvegardé";
      //On vide le tableau article pour avoir les champs de formulaire vides
      if (!isset($_GET["id"])) {
          $event = [
            'title' => '',
            'category_id' => '',
            'gender_id' => '',
            'date_debut' => '',
            'date_fin' => '',
            'location' => '',
            'content' => '',
            'image' => ''
          ];
      }
  } else {
      $errors[] = "L'article n'a pas été sauvegardé";
  }
}
}

?>
<div class="container">
  <h1><?= $pageTitle; ?></h1>

  <?php foreach ($messages as $message) { ?>
    <div class="alert alert-success" role="alert">
        <?= $message; ?>
    </div>
  <?php } ?>

  <?php foreach ($errors as $error) { ?>
    <div class="alert alert-danger" role="alert">
        <?= $error; ?>
    </div>
  <?php } ?>

  <?php if($event !== false){?> 
  <form method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label for="title">Titre:</label>
      <input type="text" class="form-control" id="title" name="title" value="<?=$event['title']; ?>">
    </div>
    <div class="form-group">
      <label for="category" class="form-label">Catégorie:</label>
      <select name="category_id" id="category" class="form-select">
        <?php foreach ($categories as $category) { ?>
          <option value="<?= $category['id']?>" <?php if (isset($event['category_id']) && $event['category_id'] == $category['id']) { ?> selected="selected" <?php }; ?>><?= $category['name'] ?></option>
        <?php } ?>
      </select>
    </div>
    <div class="form-group">
      <label for="gender">Genre:</label>
      <select class="form-control" id="gender" name="gender_id">
      <?php foreach ($genders as $gender) { ?>
          <option value="<?= $gender['id']?>" <?php if (isset($event['gender_id']) && $event['gender_id'] == $gender['id']) { ?>selected="selected" <?php }; ?>><?= $gender['name'] ?></option>
        <?php } ?>
      </select>
    </div>
    <div class="form-group">
      <label for="date_debut">Date de début:</label>
      <input type="date" class="form-control date" id="date_debut" name="date_debut" value="<?= $event['date_debut']; ?>">
    </div>
    <div class="form-group">
      <label for="date_fin">Date de fin:</label>
      <input type="date" class="form-control date" id="date_fin" name="date_fin" value="<?= $event['date_fin']; ?>">
    </div>
    <div class="form-group">
      <label for="location">Lieu:</label>
      <input type="text" class="form-control" id="location" name="location" value="<?= $event['location']; ?>">
    </div>
    <div class="form-group">
      <label for="content">Contenu:</label>
      <textarea class="form-control" id="content" name="content"><?= $event['content']; ?></textarea>
    </div>
    <!-- <div class="form-group">
      <label for="image">Image:</label>
      <input type="file" class="form-control" id="file" name="file">
    </div> -->
    <?php if (isset($_GET['id']) && isset($event['image'])&& !empty($event['image'])) { ?>
            <p>
                <img src="<?= _EVENTS_IMAGES_FOLDER_ . $event['image'] ?>" alt="<?= $event['title'] ?>" width="100">
                <label for="delete_image">Supprimer l'image</label>
                <input type="checkbox" name="delete_image" id="delete_image">
                <input type="hidden" name="image" value="<?= $event['image']; ?>">

            </p>
        <?php } ?>
        <p>
            <input type="file" name="file" id="file">
        </p>
    <input type="submit" name="saveEvent" class="btn btn-primary" value="Enregister">
  </form>
</div>
<?php }?>

<?php
require_once __DIR__ . '/templates/footer.php';
?>