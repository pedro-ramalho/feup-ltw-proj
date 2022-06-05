<?php 
  declare(strict_types = 1);

  require_once(__DIR__ . '/../database/connection.php');
  require_once(__DIR__ . '/../classes/user.class.php');
?>

<?php function draw_profile_form(User $user) { ?>
  <form id="account-form" action="#" method="post">
    <label for="username">
      Username<input id="username" type="text" value="<?=$user->username?>">
    </label>
    <label for="address">
      Address<input id="address" type="text" value="<?=$user->address?>">
    </label>
    <label for="phone-number">
      Phone number<input id="phone-number" type="text" value="<?=$user->phone_number?>">
    </label> 
    <label for="password">
      Password<input id="password" type="password">
    </label>
    <button class="save" type="submit">Save</button>
  </form>
<?php } ?>