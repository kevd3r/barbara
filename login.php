<?php
require_once __DIR__ . '/lib/config.php';
require_once __DIR__ . '/lib/session.php';
require_once __DIR__ . '/lib/pdo.php';
require_once __DIR__ . '/lib/user.php';
require_once __DIR__ . '/lib/menu.php';

$mainMenu["login.php"] = [
  "title" => "Login",
  "head_title" => "Connexion",
  "meta_description" => "Dashboard",
  "exlude" => true
];
require_once __DIR__ . "/templates/header.php";

$errors = [];
$messages = [];

if (isset($_POST['loginUser'])) {
  $user = verifyUserLoginPassword($pdo, $_POST['email'], $_POST['password']);
  if ($user) {
    session_regenerate_id(true);
    $_SESSION['user'] = $user;
    if ($user['role'] === "admin") {
      header('location: admin/index.php');
    } else {
      header("location: index.php");
    }
  } else {
    $errors = ['Email ou mot de passe incorrect'];
  }
}

?>
<div class="login container-fluid pt-4">
  <h1 class="mt-3 border-bottom">Connexion</h1>

  <?php foreach ($errors as $error) { ?>
    <div class="alert alert-danger">
      <?= $error; ?>
    </div>
  <?php } ?>
  <form method="post">
    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" name="email" id="email" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Mot de passe</label>
      <input type="password" name="password" id="password" class="form-control">
    </div>
    <input type="submit" value="Connexion" name="loginUser" class="btn btn-primary">
  </form>
</div>


<?php
require_once __DIR__ . "/templates/footer.php";
?>