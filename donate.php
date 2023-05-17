<?php
require_once 'utils.php';
echo head("Donate", "donate");
?>
<h1>
  <center class="title">Donate</center>
</h1>

<div class="container">
  <div class="row row-gap-2">

    <form action="donate.php" class="row g-3" method="POST" enctype="multipart/form-data">

      <div class="col-md-6">
        <label class="form-label" for="item_name">Item Name</label>
        <input class="form-control" type="text" id="item_name" name="item_name" required>
      </div>

      <div class="col-md-6">
        <label class="form-label" for="category">Category</label>
        <select class="form-control" id="category" name="category">
          <option value="" selected disabled hidden>Choose here</option>
          <option value="1">computers</option>
          <option value="2">phones</option>
          <option value="3">television</option>
          <option value="4">appliances</option>
          <option value="5">batteries</option>
          <option value="6">others</option>
        </select>
      </div>

      <div class="col-md-12">
        <label class="form-label" for="description">Description</label>
        <input class="form-control" type="text" id="description" name="description" required>
      </div>

      <div class="col-md-6">
        <label class="form-label" for="image">Image</label>
        <input class="form-control" type="file" accept="image/*" id="image" name="image" required>
      </div>

      <div class="col-md-6">
        <label class="form-label" for="quantity">Quantity</label>
        <input class="form-control" type="number" id="quantity" name="quantity" min="1" step="1" required>
      </div>

      <div class="col-12">
        <button type="submit" class="btn btn-warning" style="display: flex; float: right;">Submit</button>
      </div>
    </form>
    <?php
    $categories = array("computers", "phones", "television", "appliances", "batteries", "others");
    ?>


  </div>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['item_name'], $_POST['category'], $_POST['description'], $_POST['quantity'], $_FILES["image"])) {
    // image part
    $path_filename_ext = "";
    if ($_FILES["image"]["name"] != "") {
      $target_dir = "blob/" . $_SESSION["user"]["id"] . "/";
      $image = $_FILES["image"]["name"];
      $path = pathinfo($image);

      $filename = $path["filename"] . $_SERVER["REQUEST_TIME"];
      $ext = $path["extension"];
      $temp_name = $_FILES["image"]["tmp_name"];
      $path_filename_ext = $target_dir . $filename . "." . $ext;
      // var_dump($path);
      // echo $image . "<br>";
      // var_dump($_FILES["image"]);
      // echo $filename . "<br>";
      // echo $temp_name . "<br>";
      // echo $path_filename_ext;
      if (!file_exists($target_dir)) {
        mkdir($target_dir);
      }
      move_uploaded_file($temp_name, $path_filename_ext);
    }

    // Retrieve and sanitize the form data
    $item_name = cleanInput($_POST['item_name']);
    $category = cleanInput($_POST['category']);
    $description = cleanInput($_POST['description']);
    $quantity = cleanInput($_POST['quantity']);

    // Process the form data further (e.g., store in a database, perform actions, etc.)
// Prepare the SQL statement
    $sql = "INSERT INTO donation (user_id, item_name, category_id, description, image, quantity) VALUES (?, ?, ?, ?, ?, ?)";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Bind the form data to the prepared statement parameters
    $stmt->bind_param("issssi", $_SESSION["user"]["id"], $item_name, $category, $description, $path_filename_ext, $quantity);

    // Execute the prepared statement
    if ($stmt->execute()) {
      // Data inserted successfully
      // echo "Data inserted successfully.";
      echo "<script>window.location = 'index.php'</script>";
    } else {
      // Error occurred
      echo "Error occurred while inserting data.";
    }
    $stmt->close();
    $conn->close();
  }
}


echo footer();