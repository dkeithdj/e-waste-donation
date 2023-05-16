<?php
include 'config.php';
require_once 'utils.php';
echo head("Login", "login");
?>

<div class="container">

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
      <button type="submit" name="login" class="btn btn-warning">login</button>
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

  // $result = mysqli_query(connect(), $sql);
  // $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  // $count = mysqli_num_rows($result);

  if ($stmt->execute()) {
    $result = $stmt->get_result();
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $_SESSION["user"] = $row;
    // $_SESSION["user_id"] = $row["id"];
    // $_SESSION["login_user"] = $row["username"];
    echo "<script>console.log('huhu')</script>";

    header("location: index.php");
  } else {
    echo "<script>console.log('haha')</script>";
    $error = "Your email address or password is invalid";
  }
} else {
  debug("somthing wrong");
}
echo footer();