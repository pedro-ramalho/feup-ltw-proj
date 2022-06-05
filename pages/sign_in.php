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
  <link rel="stylesheet" href="../css/pages/page_sign_in.css">
  <title>Sign in to Agile Eating</title>
  <script src="../javascript/sidebar_button.js" defer></script>
  <script src="../javascript/messages.js" defer></script>
</head>
<body>
  <?php draw_sidebar($session) ?>
  <?php draw_header($session) ?>
  <main>
    <section id="signin">
      <h2 class="slogan">Your next meal is only a click away</h2>
      <form action="../actions/action_sign_in.php" method="post">
        <input type="text" name="username" id="username" placeholder="username">
        <input type="password" name="password" id="password" placeholder="password">
        <button type="submit">Sign in</button>
      </form>
      <h5><a href="sign_up.php">Don't have an account? Sign up instead</a></h5>
    </section>
  </main>
  <?php draw_footer() ?>
</body>
</html>