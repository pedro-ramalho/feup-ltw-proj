<?php
  declare(strict_types = 1); 
  require_once(__DIR__ . '/../utils/session.php');
?>

<?php function draw_header(Session $session) { ?>
  <section id="search-results-container" class="hidden-search-results">
  </section>
  <header>
    <div id="sidebar-button-container">
      <button id="toggle-sidebar" class="hamburger">
        <svg xmlns="http://www.w3.org/2000/svg" height="32" width="32" id="hamburger"><path d="M 4 24 V22 H28 V24 Z M 4 17 V15 H28 V17 Z M 4 10 V8 H28 V10 Z"/></svg>
        <svg xmlns="http://www.w3.org/2000/svg" height="32" width="32" id="close"><path d="M8.3 25.1 6.9 23.7 14.6 16 6.9 8.3 8.3 6.9 16 14.6 23.7 6.9 25.1 8.3 17.4 16 25.1 23.7 23.7 25.1 16 17.4Z"/></svg>
      </button>
      <a href="/">Agile Eating</a>
    </div>
    <div id="search-bar-container">
      <form id="search-bar" autocomplete="off">
        <input type="search" id="query" placeholder="Search..." autocomplete="off">
      </form>
    </div>
    <?php draw_header_acc($session) ?>
  </header>
  <section id="messages-container">
    <?php foreach ($session->getMessages() as $message) { ?>
      <article class="<?=$message['type']?>">
          <p><?=$message['text']?></p>
        </article>
      <?php } ?>
  </section>
<?php } ?>

<?php function draw_sidebar(Session $session) { ?>
  <aside id="sidebar">
      <nav id="menu">
        <section id="highlight" class="sidebar-section">
          <ul>
            <li id="sidebar-home"><a href="/"><span>Home</span></a></li>
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
          <?php draw_sb_acc($session) ?>
        </section>    
      </nav>
    </aside>
<?php } ?>

<?php function draw_footer() { ?>
  <footer>
    <h4>&copy;2022 Agile Eating, Inc.</h4>
    <div id="media-container">
      <div id="twitter" class="media">
        <img src="../assets/icons/twitter.svg" class="icon">
        <p>@AgileEating</p>
      </div>
      <div id="instagram" class="media">
        <img src="../assets/icons/instagram.svg" class="icon">
        <p>@AgileEating</p>
      </div>
      <div id="facebook" class="media">
        <img src="../assets/icons/facebook.svg" class="icon">
        <p>AgileEating</p>
      </div>
    </div>
  </footer>
<?php } ?>
  
<?php 
  function draw_sb_acc(Session $session) { 
    if (!$session->isLoggedIn()) { ?>
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
  function draw_header_acc(Session $session) { 
    if (!$session->isLoggedIn()) { ?>
      <div id="header-signup">
        <a href="../pages/sign_in.php">Sign in</a>
        <a href="../pages/sign_up.php">Sign up</a>
      </div>
    <?php } 
    else { ?>
      <div id="header-account">
        <form action="../actions/action_sign_out.php" method="post" class="logout">
          <button type="submit">Sign out</button>
        </form>
        <a href="../pages/profile.php">Profile</a>
      </div>
    <?php 
    } 
  } 
?>

<?php
  function draw_stickers() { ?>
    <h1 id="stickers-header">How does it work?</h1>
    <section id="stickers">
      <article class="sticker-container">
        <figure>
          <img src="assets/icons/rounded_star.svg" class="large-icon">
          <figcaption>Best choice</figcaption>
          <p>Find a wide variety of restaurants and dishes</p>
        </figure>
      </article>
      <article class="sticker-container">
        <figure>
          <img src="assets/icons/star.svg" class="large-icon">
          <figcaption>User reviews</figcaption>
          <p>Recommendations and reviews from a powerful community</p>
        </figure>
      </article>
      <article class="sticker-container">
        <figure>
          <img src="assets/icons/calendar.svg" class="large-icon">
          <figcaption>Easy ordering</figcaption>
          <p>Instant, free and easy, from anywhere you are</p>
        </figure>
      </article>
    </section>
<?php } ?>