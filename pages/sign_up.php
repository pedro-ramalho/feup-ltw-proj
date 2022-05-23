<?php
  require_once(__DIR__ . '/../templates/common.php');

  session_start();
  if (isset($_SESSION['id'])) die(header('Location: /'));
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
  <link rel="stylesheet" href="../css/pages/page_sign_up.css">
  <title>Join Agile Eating</title>
  <script src="../javascript/sidebar_button.js" defer></script>
</head>
<body>
  <?php draw_sidebar() ?>
  <?php draw_header() ?>
  <main>
    <section id="signup">
      <h2 class="slogan">Your next meal is only a click away</h2>
      <form action="../actions/action_sign_up.php" method="post">
        <input type="text" name="username" id="username" placeholder="username">
        <input type="password" name="password" id="password" placeholder="password">
        <input type="password" name="password" id="confirm-password" placeholder="confirm password">
        <input type="tel" name="phone-number" id="phone-number" placeholder="phone-number">
        <input type="text" name="address" id="address" placeholder="address">
        <button type="submit" formaction="database/register.php" formmethod="post">Sign up</button>
      </form>
      <h5><a href="sign_in.php">Already have an account? Sign in instead</a></h5>
    </section>
  </main>
  <?php draw_footer() ?>
</body>
</html>