<?php
  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();
  require_once(__DIR__ . '/../templates/common.php');
  
  if ($session->isLoggedIn()) die(header('Location: /'));
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/layout.css">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/sidebar.css">
  <link rel="stylesheet" href="../css/responsive.css">
  <link rel="stylesheet" href="../css/pages/main-page.css">
  <link rel="stylesheet" href="../css/pages/page_sign_up.css">
  <link rel="icon" href="../assets/logo/favicon.png">
  <title>Join Agile Eating</title>
  <script src="../javascript/sidebar_button.js" defer></script>
  <script src="../javascript/dynamic_search.js" defer></script>
  <script src="../javascript/messages.js" defer></script>
  <script src="../javascript/header_scroll.js" defer></script>
</head>
<body>
  <?php draw_sidebar($session) ?>
  <?php draw_header($session) ?>
  <main>
    <section id="signup">
      <h2 class="slogan">Your next meal is only a click away</h2>
      <form action="../actions/action_sign_up.php" method="post">
        <input type="text" name="username" id="username" placeholder="username" require="required">
        <input type="password" name="password" id="password" placeholder="password" require="required" minlength="8">
        <input type="password" name="confirm-password" id="confirm-password" placeholder="confirm password" require="required">
        <input type="tel" name="phone-number" id="phone-number" placeholder="phone-number" require="required">
        <input type="text" name="address" id="address" placeholder="address" require="required">
        <button type="submit">Sign up</button>
      </form>
      <h5><a href="sign_in.php">Already have an account? Sign in instead</a></h5>
    </section>
  </main>
  <?php draw_footer() ?>
</body>
</html>