<?php
  require_once('templates/common.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign in to Agile Eating</title>
</head>
<body>
  <?php draw_header() ?>

  <section id="signin">
    <h2 class="slogan">Your next meal is only a click away</h2>
    <fieldset>
      <input type="text" name="username" id="username" method="get" placeholder="username">
      <input type="password" name="password" id="password" method="get" placeholder="password">
      <button type="submit">Sign in</button>
    </fieldset>
    <h5><a href="sign_up.php">Don't have an account? Sign up instead</a></h5>
  </section>

  <?php draw_footer() ?>
</body>
</html>