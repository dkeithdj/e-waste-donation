<?php
include 'config.php';
require_once 'modals.php';
require_once 'utils.php';
echo head("Login", "login");
?>

<div class="container">

  <h1>
    <center class="title">Login</center>
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
      <button type="submit" name="login" class="btn btn-warning" style="display: flex; float: right;">login</button>
    </div>
  </form>
</div>

<?php
if (isset($_POST["email"], $_POST["password"])) {
  $email_address = mysqli_real_escape_string($conn, $_POST["email"]);
  $password = mysqli_real_escape_string($conn, $_POST["password"]);

  $sql = "SELECT * FROM user WHERE email_address='$email_address' AND password='$password'";
  $stmt = mysqli_prepare($conn, "SELECT * FROM user WHERE email_address=? AND password=?");
  $stmt->bind_param("ss", $email_address, $password);

  $stmt->execute();
  $result = $stmt->get_result();
  if ($result->num_rows > 0) {
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $_SESSION["user"] = $row;

    echo "<script>window.location = 'index.php'</script>";
  } else {
    $message = "Email or password is incorrect, try again";
    echo login_error($message);
    ?>
    <script>
      $(document).ready(function () {
        $("#loginErrorModal").modal("show");
      });
    </script>
    <?php
  }
} else {
  debug("somthing wrong");
}
echo footer();