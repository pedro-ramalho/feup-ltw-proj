<?php
  require_once('templates/common.php');

  session_start();
  if (isset($_SESSION['id'])) die(header('Location: /'));
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/layout.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/sidebar.css">
  <link rel="stylesheet" href="css/pages/signin-page.css">
  <title>Sign in to Agile Eating</title>
  <script src="javascript/sidebar-button.js" defer></script>
</head>
<body>
  <?php draw_sidebar() ?>
  <?php draw_header() ?>
  <main>
    <section id="signin">
      <h2 class="slogan">Your next meal is only a click away</h2>
      <form action="database/action_sign_in.php" method="post">
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