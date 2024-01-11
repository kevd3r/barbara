<?php
session_set_cookie_params([
  'lifetime' => 3600,
  'path' => '/',
  'domain' => _DOMAIN_,
  // 'secure'=>true,
  'httponly' => true
]);
session_start();

function adminOnly()
{
  if (!isset($_SESSION['user'])) {
    // rediriger vers la page de login
    header('location: ../login.php');
  } elseif ($_SESSION['user']['role'] != "admin") {
    header('location: ../index.php');
  }
}
