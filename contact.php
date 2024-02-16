<?php
require_once __DIR__ . '/lib/config.php';
require_once __DIR__ . '/lib/pdo.php';
require_once __DIR__ . '/lib/menu.php';
require_once __DIR__ . '/templates/header.php';
require_once __DIR__ . '/lib/event.php';




use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// Inclure les fichiers de PHPMailer
require_once './vendor/autoload.php';

$message_sent = false; // Initialisation à false


if (isset($_POST['submit'])) {
  $firstname = htmlspecialchars($_POST['firstname']);
  $lastname = htmlspecialchars($_POST['lastname']);
  $email = htmlspecialchars($_POST['email']);
  $message = htmlspecialchars($_POST['message']);

  // Créer une instance de PHPMailer
  $mail = new PHPMailer(TRUE);
  try {

    $mail->setFrom('jost.ba@barbarajost.fr', 'Barbara Jost');
    $mail->addAddress('jost.ba@barbarajost.fr', 'Princess');
    $mail->CharSet = 'UTF-8'; // Définir l'encodage des caractères
    $mail->Encoding = 'base64';
    $mail->Subject = 'Message du Formulaire de contact';
    $mail->Body = $message;
    $mail->isHTML(false);

    /* SMTP parameters. */

    /* Tells PHPMailer to use SMTP. */


    $mail->isSMTP();

    /* SMTP server address. */
    $mail->Host = 'smtp.hostinger.com';
    /* Use SMTP authentication. */
    $mail->SMTPAuth = TRUE;

    /* Set the encryption system. */
    $mail->SMTPSecure = 'starttls';

    /* SMTP authentication username. */
    $mail->Username = 'jost.ba@barbarajost.fr';

    /* SMTP authentication password. */
    $mail->Password = 'Mathe@06';

    /* Set the SMTP port. */
    $mail->Port = 587;

    /* Finally send the mail. */
    $mail->send();
    $message_sent = true;
  } catch (Exception $e) {
    echo $e->errorMessage();
  } catch (\Exception $e) {
    echo $e->getMessage();
  }
}

?>



<div class="contact-main d-flex justify-content-center align-items-center col-12 row">
  <div class="container-fluid col-10 col-md-8 col-lg-6 col-xl-4 contact-first p-3 m-5">
    <h2 class="text-center py-3">Contact Direct</h2>
    <p class=" text-center"><i class="bi bi-envelope"></i> Par email <a href="mailto:jost.ba@barbarajost.fr">
        ICI</a></p>
    <p class=" text-center"><i class="bi bi-telephone"></i> Par téléphone à <a href="tel:0619014883">ce numéro</a>
    </p>
  </div>
  <div class="form-container col-12 d-flex justify-content-center mb-5 form">
    <div class="row g-2 col-10 col-md-8 col-lg-6 col-xl-4 formulaire p-md-5 p-2" class="row">
      <?php if (!$message_sent) { ?>
        <form action="./contact.php" method="POST" role="form" id="form" class="row">
          <div class="form-title">
            <h2 class="text-center pb-3">Formulaire de Contact</h2>
          </div>
          <div class="g-recaptcha" data-sitekey="6LczEXQpAAAAAHn7S6NK6kJ4SEbTqQKOoRS3c23i"></div>
          <div class="mb-3 col-12 col-md-6">
            <label for="firstname" class="form-label">Votre Prénom </label>
            <input type="text" class="form-control" placeholder="Votre Prénom" name="firstname" autocomplete="given-name" required>
          </div>
          <div class="mb-3 col-12 col-md-6">
            <label for="lastname" class="form-label">Votre Nom</label>
            <input type="text" class="form-control" placeholder="Votre Nom" name="lastname" required autocomplete="family-name">
          </div>
          <div class="mb-3 ">
            <label for="email" class="form-label">Votre email</label>
            <input type="email" class="form-control" placeholder="votreadresse@mail.com" name="email" autocomplete="email" required>
          </div>
          <div class="mb-3 ">
            <label for="message" class="form-label">Votre Message</label>
            <textarea class="form-control" rows="5" name="message" placeholder="Votre message ici ..." required></textarea>
          </div>
          <div class="col-12 pb-3">
            <button class="btn btn-primary col-12 " type="submit" name="submit">Valider</button>
        </form>
      <?php } else { ?>
        <div class="container">
        <h2 class="text-center">Votre message a bien été envoyé</h2>
          <a href="/" class="btn btn-primary col-12">Retour à l'accueil</a>
        </div>
      <?php } ?>
    </div>
  </div>
</div>




<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
    // Réinitialiser les champs du formulaire après l'envoi
    window.onload = function() {
        <?php if ($message_sent) : ?>
            document.getElementById('form').reset();
        <?php endif; ?>
    }
</script>
<?php
require_once __DIR__ . '/templates/footer.php';
?>