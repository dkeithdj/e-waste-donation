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
  // $isLoggedIn = false;
  // $isAdmin = false;
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
    <link rel="stylesheet" href="blob/fontawesome/css/brands.css">
    <link rel="stylesheet" href="blob/fontawesome/css/fontawesome.css">
    <link rel="stylesheet" href="blob/fontawesome/css/solid.css">
    <link rel="stylesheet" href="blob/fontawesome/css/regular.css">
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
    <nav class="navbar navbar-expand-lg  sticky-top nav-color" data-bs-theme="dark">
      <div class="container-fluid">
        <a class="title navbar-brand " href="index.php">E-Donate</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="index.php#the-facts">the facts</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php#the-information">the information</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php#faq">faq</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php#donate">donate</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php#contact">contact</a>
            </li>
          </ul>

          <ul class="navbar-nav me-2 mb-2 mb-lg-0">
            <?php if ($isLoggedIn): ?>
              <?php if ($isAdmin): ?>
                <li class="nav-item">
                  <a href="admin.php" class="nav-link">admin</a>
                </li>
                <li class="nav-item">
                  <a href=" logout.php" class="nav-link">logout</a>
                </li>
              <?php else: ?>
                <li class="nav-item dropstart">
                  <a class="nav-link dropdown-toggle" href="javascript:void(0)" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <?= $_SESSION["user"]["username"] ?>
                  </a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="account.php">account</a></li>
                    <li><a class="dropdown-item" href="donate.php">donations</a></li>
                    <li>
                      <hr class="dropdown-divider">
                    </li>
                    <li>
                      <p class="dropdown-item mb-0">🏆 Tokens:
                        <?= $_SESSION["user"]["tokens"] ?>
                      </p>
                    </li>
                  </ul>
                </li>
                <li class="nav-item">
                  <a href=" logout.php" class="nav-link">logout</a>
                </li>
              <?php endif; else: ?>
              <li class="nav-item" style="float:right;">
                <a href="login.php" class="nav-link">login</a>
              </li>
              <li class="nav-item" style="float:right;">
                <a href="register.php" class="nav-link">register</a>
              </li>
            <?php endif ?>
          </ul>

        </div>
      </div>
    </nav>
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

function cleanInput($data)
{
  $data = trim($data);
  $data = filter_var($data);
  return $data;
}

function debug($text)
{
  echo "<script>console.log('$text')</script>";
}