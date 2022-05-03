<?php function draw_header() { ?>
  <header>
    <input type="checkbox" id="hamburger">
    <label class="hamburger" for="hamburger"></label>
    <aside id="sidebar">
      <nav id="menu">
        <ul>
          <li><a href="index.php"><span>Home</span></a></li>
          <li><a href="#"><span>Hot Deals</span></a></li>
          <li><a href="action_sign_in.php"><span>Sign In</span></a></li>
          <li><a href="action_sign_up.php"><span>Sign Up</span></a></li>
          <li><a href="#"><span>Cookies Policy</span></a></li>
        </ul>
      </nav>
    </aside>
    <div id="search-bar-container">
      <form id="search-bar">
        <input type="search" id="query" placeholder="Search...">
      </form>
    </div>
    <div id="signup">
      <a href="action_sign_in.php">Sign in</a>
      <a href="action_sign_up.php">Sign up</a>
    </div>
  </header>
<?php } ?>

<?php function draw_footer() { ?>
  <footer>
    <h4>&copy;2022 Glove, Inc.</h4>
  </footer>
<?php } ?>
