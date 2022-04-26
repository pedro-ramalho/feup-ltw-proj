<?php function draw_header() { ?>
  <header>
    <aside id="sidebar">
      <nav id="menu">
        <input type="checkbox" id="hamburger">
        <label class="hamburger" for="hamburger"></label>
        <ul>
          <li><a href="#">Home</a></li>
          <li><a href="#">Hot Deals</a></li>
          <li><a href="#">Sign In</a></li>
          <li><a href="#">Sign Up</a></li>
          <li><a href="#">Cookies Policy</a></li>
        </ul>
      </nav>
    </aside>
    <div id="search-bar-container">
      <form id="search_bar">
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
