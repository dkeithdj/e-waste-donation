<?php
require_once 'utils.php';
include 'config.php';
echo head("Register", "register");
?>

<div class="container">
  <h1>
    <center class="title">Register</center>
  </h1>
  <form onsubmit="return confirm_password()" action="register.php" class="row g-3" method="POST">
    <div class="col-md-6">
      <label class="form-label">First Name</label>
      <input type="text" class="form-control" name="first_name" required>
    </div>
    <div class="col-md-6">
      <label class="form-label">Last Name</label>
      <input type="text" class="form-control" name="last_name" required>
    </div>
    <div class="col-md-6">
      <label class="form-label">Username</label>
      <input type="text" class="form-control" name="username" required>
    </div>
    <div class="col-md-6">
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
      <button type="submit" name="submit" class="btn btn-warning" style="display: flex; float: right;">Submit</button>
    </div>
  </form>
</div>
<?php

// $inputs = array("first_name", "last_name", "username", "email", "address", "contact", "password", "retype_password");
// $good = false;
// foreach ($inputs as $input) {
//   (isset($_POST[$input])) ? $good = true : $good = false;
// }
// if ($good) {
//   foreach ($inputs as $input) {
//     echo $_POST[$input] . "<br>";
//   }
// }

if (isset($_POST['submit'])) {
  // Retrieve and clean form data
  $first_name = cleanInput($_POST['first_name']);
  $last_name = cleanInput($_POST['last_name']);
  $username = cleanInput($_POST['username']);
  $email = cleanInput($_POST['email']);
  $address = cleanInput($_POST['address']);
  $contact = cleanInput($_POST['contact']);
  $password = cleanInput($_POST['password']);

  $reg = $conn->prepare("INSERT INTO user (first_name, last_name, username, email_address, address, contact_number, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
  $reg->bind_param("sssssss", $first_name, $last_name, $username, $email, $address, $contact, $password);

  if ($reg->execute()) {
    echo "<script>window.location = 'login.php'</script>";
  } else {
    echo "Error: " . $reg->error;
  }

  // Close the statement and database connection
  $reg->close();
  $conn->close();
}

echo footer();