<?php
include 'config.php';
require_once 'modals.php';
require_once 'utils.php';
echo head("Login", "login");
?>

<div class="container px-5">

  <h1>
    <center class="title pt-2">Login</center>
  </h1>
  <form class="row g-3" action="login.php" method="POST">
    <div class="col-md-12">
      <label class="form-label">Email</label>
      <input type="email" class="form-control" name="email" required>
    </div>
    <div class="col-md-12">
      <label class="form-label">Password</label>
      <input type="password" class="form-control" name="password" required>
    </div>
    <div class="col-md-12">
      <button id="login" type="submit" name="login" class="btn btn-warning"
        style="display: flex; float: right;">login</button>
    </div>
  </form>
</div>

<?php
$max_login_attempts = 3;
$timeout_duration = 30; // 30 seconds

if (!isset($_SESSION['login_attempts'])) {
  $_SESSION['login_attempts'] = 0;
  $_SESSION['last_login_attempt'] = time();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $email_address = mysqli_real_escape_string($conn, $_POST["email"]);
  $password = mysqli_real_escape_string($conn, $_POST["password"]);

  if (time() - $_SESSION['last_login_attempt'] > $timeout_duration) {
    $_SESSION['login_attempts'] = 0;
  }

  $sql = "SELECT * FROM user WHERE email_address='$email_address' AND password='$password'";
  $stmt = mysqli_prepare($conn, "SELECT * FROM user WHERE email_address=? AND password=?");
  $stmt->bind_param("ss", $email_address, $password);

  $stmt->execute();
  $result = $stmt->get_result();
  if ($result->num_rows > 0) {
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $_SESSION["user"] = $row;

    $_SESSION['login_attempts'] = 0;
    $_SESSION['last_login_attempt'] = time();

    echo "<script>window.location = 'index.php'</script>";
  } else {
    // Increment login attempts
    $_SESSION['login_attempts']++;

    // Check if maximum login attempts reached
    if ($_SESSION['login_attempts'] >= $max_login_attempts) {
      // Display error message or take appropriate action
      $reset = $_SESSION['last_login_attempt'] + $timeout_duration;
      $message = "Maximum login attempts reached. Please try again later. <br>" . $reset - time() . "s remaining.";
      echo login_error($message);
      echo '<script> $(document).ready(function () { $("#loginErrorModal").modal("show"); }); </script>';
      echo '<script>document.getElementById("login").setAttribute("disabled","");</script>';
      echo '<script>document.getElementById("navtop").style.display = "none";</script>';
      exit();
    } else {
      // Display error message for invalid credentials
      $message = "Invalid username or password. <br> attempts took: " . $_SESSION["login_attempts"] . "<br>Maximum attempts: 3";
      echo login_error($message);
      echo '<script> $(document).ready(function () { $("#loginErrorModal").modal("show"); }); </script>';
    }

    // Update last login attempt time
    $_SESSION['last_login_attempt'] = time();
    // re-enable button
    $reset = $_SESSION['last_login_attempt'] + $timeout_duration;
    if ($reset < time()) {
      echo '<script>document.getElementById("navtop").style.display = "flex";</script>';
      echo '<script>document.getElementById("login").removeAttribute("disabled");</script>';
    }

    // echo login_error($message);
    // echo '<script> $(document).ready(function () { $("#loginErrorModal").modal("show"); }); </script>';
  ?>
  <?php
  }
}
echo footer();