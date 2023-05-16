<?php
session_start();
include 'config.php';
function head($title, $activepage)
{
  $user_id = 0;
  $isAdmin = 0;
  if (isset($_SESSION["user"])) {
    $user_id = $_SESSION["user"]["id"];
    $isAdmin = $_SESSION["user"]["isAdmin"];

  }
  $isLoggedIn = ($user_id != 0) ? true : false;
  $isAdmin = ($isAdmin == 1) ? true : false;
  ob_start(); ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
      crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <title>
      <?= $title; ?>
    </title>

    <script>     const setActive = (e) => { if (document.querySelector("a.link-head.active") !== null) { document.querySelector("a.link-head.active").classList.remove("active"); } e.target.className = "link-head active" }

    </script>
  </head>


  <body style="background-color: #00212a;">

    <!-- <section onclick="setActive(event)" id="headd">
      <a href="#?id=1" class="link-head active">A</a>
      <a href="#" class="link-head">B</a>
      <a href="#" class="link-head">C</a>
      <a href="#" class="link-head">D</a>
    </section> -->
    <ul class="header">
      <li>
        <a href="<?php echo 'index' ?>.php">
          <h1 class="title" style="padding: 8px 1rem 0 1rem; font-size: 2rem;">E-Donor</h1>
        </a>
      </li>
      <li>
        <a href="index.php#the-facts" class="link-head">the facts</a>
      </li>
      <li>
        <a href="index.php#the-information" class="link-head">the information</a>
      </li>
      <li>
        <a href="index.php#faq" class="link-head">faq</a>
      </li>
      <li>
        <a href="index.php#donate" class="link-head">donate</a>
      </li>
      <li>
        <a href="index.php#contact" class="link-head">contact</a>
      </li>
      <?php if ($isLoggedIn): ?>
        <li style="float:right;">
          <a href="logout.php" class="link-head">logout</a>
        </li>
        <?php if ($isAdmin): ?>
          <li style="float:right;">
            <a href="admin.php" class="link-head">admin</a>
          </li>
        <?php else: ?>
          <li style="float:right;">
            <a href="account.php" class="link-head">
              <?= $_SESSION["user"]["username"] ?>
            </a>
          </li>
        <?php endif; else: ?>
        <li style="float:right;">
          <a href="<?php echo 'register.php'; ?>" class="link-head">register</a>
        </li>
        <li style="float:right;">
          <a href="login.php" class="link-head">login</a>
        </li>
      <?php endif ?>
    </ul>
    <!-- Modal data-bs-toggle="modal" data-bs-target="#exampleModal" -->
    <!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header theme" data-bs-theme="dark">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Login</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body theme">

          </div>
        </div>
      </div>
    </div> -->

    <?php

    return ob_get_clean();
}

function footer()
{
  ob_start(); ?>
    <script defer src="script.js"></script>
  </body>

  </html>
  <?php
  return ob_get_clean();
}

function debug($text)
{
  echo "<script>console.log('$text')</script>";
}