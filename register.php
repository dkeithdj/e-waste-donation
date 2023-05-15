<?php
require_once 'utils.php';
echo head("Register", "register");
?>

<!-- <script src="script.js"> </script> -->
<section class="mx-5 adjust">
  <h1>Register</h1>
  <form onsubmit="return confirm_password()" action="index.php#" class="row g-3" method="post">
    <div class="col-md-6">
      <label for class="form-label">First Name</label>
      <input type="text" class="form-control" name="first_name" required>
    </div>
    <div class="col-md-6">
      <label class="form-label">Last Name</label>
      <input type="text" class="form-control" name="last_name" required>
    </div>
    <div class="col-md-12">
      <label class="form-label">Email Address</label>
      <input type="email" class="form-control" name="email" required>
    </div>
    <div class="col-12">
      <label class="form-label">Address</label>
      <input type="text" class="form-control" placeholder="1234 Main St" name="address" required>
    </div>
    <div class="col-12">
      <label class="form-label">Contact Number</label>
      <input type="text" class="form-control" placeholder="+63 123 4564 4564" name="contact" required>
    </div>
    <div class="col-md-6">
      <label class="form-label">Password</label>
      <input id="password" type="password" class="form-control" name="password" required>
    </div>
    <div class="col-md-6">
      <label class="form-label">Retype Password</label>
      <input id="re-password" type="password" class="form-control" name="retype_password" required>
    </div>
    <div class="col-12">
      <button type="submit" class="btn btn-warning" style="display: flex; float: right;">Submit</button>
    </div>
  </form>
</section>
<?php

$inputs = array("first_name", "last_name", "email", "address", "contact", "password", "retype_password");
$good = false;
foreach ($inputs as $input) {
  (isset($_POST[$input])) ? $good = true : $good = false;
}
if ($good) {
  foreach ($inputs as $input) {
    echo $_POST[$input] . "<br>";
  }
}

echo footer();