<?php 
  declare(strict_types = 1);

  require_once('database/connection.php');

  require_once('database/classes/user.class.php');
?>

<?php function draw_profile_form(User $user) { ?>
  <form id="account-form" action="#" method="post">
    <label for="username">
      Username<input id="username" type="text" value="<?=$user->username?>">
    </label>
    <label for="password">
      Password<input id="password" type="password">
    </label>
    <button type="submit">Save</button>
  </form>
<?php } ?>