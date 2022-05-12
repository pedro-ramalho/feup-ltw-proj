<?php function draw_header() { ?>
  <header>
    <input type="checkbox" id="hamburger">
    <label class="hamburger" for="hamburger"></label>
    <aside id="sidebar">
      <nav id="menu">
        <section id="highlight" class="sidebar-section">
          <ul>
            <li><a href="index.php"><span>Home</span></a></li>
            <li><a href="#"><span>Hot Deals</span></a></li>
          </ul>
        </section>  
        <section id="browse" class="sidebar-section">
          <h1>BROWSE</h1>
          <ul>
            <li><a href=""><span>Browse dishes</span></a></li>
            <li><a href=""><span>Random dish</span></a></li>
            <li><a href=""><span>Browse restaurants</span></a></li>
            <li><a href=""><span>Random restaurant</span></a></li>
          </ul>
        </section>
        <section id="account" class="sidebar-section">
          <h1>ACCOUNT</h1>
          <?php draw_sb_acc() ?>
        </section>    
      </nav>
    </aside>
    <div id="search-bar-container">
      <form id="search-bar">
        <input type="search" id="query" placeholder="Search...">
      </form>
    </div>
    <?php draw_header_acc() ?>
  </header>
<?php } ?>

<?php function draw_footer() { ?>
  <footer>
    <h4>&copy;2022 Agile Eating, Inc.</h4>
  </footer>
<?php } ?>

<?php 
  function draw_sb_acc() { 
    if (!isset($_SESSION['id'])) { ?>
    <ul>
      <li><a href=""><span>Sign in</span></a></li>
      <li><a href=""><span>Sign up</span></a></li>
    </ul>
    <?php } 
    else { ?>
      <ul>
        <li><a href="#"><span>Profile</span></a></li>
        <li><a href="#"><span>Favorites</span></a></li>
        <li><a href="#"><span>Sign out</span></a></li>
      </ul>
    <?php 
    } 
  } 
?>

<?php 
  function draw_header_acc() { 
    if (!isset($_SESSION['id'])) { ?>
      <div id="header-signup">
        <a href="sign_in.php">Sign in</a>
        <a href="sign_up.php">Sign up</a>
      </div>
    <?php } 
    else { ?>
      <div id="header-account">
        <form action="database/action_sign_out.php" method="post" class="logout">
          <button type="submit">Sign out</button>
        </form>
        <a href="profile.php">Profile</a>
      </div>
    <?php 
    } 
  } 
?>