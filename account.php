<?php
require_once 'utils.php';
include 'config.php';
echo head("Account", "account");

// if (isset($_GET["id"])) {
$id = $_SESSION["user"]["id"];
// $qry = "SELECT * FROM donation WHERE user_id = $id";

$qry = "SELECT d.*, u.username, c.category_name ";
$qry .= "FROM donation d ";
$qry .= "JOIN user u ON d.user_id = u.id ";
$qry .= "JOIN category c ON d.category_id = c.id ";
$qry .= "WHERE user_id = $id ";
$qry .= "ORDER BY date_time DESC;";

$updateToken = mysqli_query($conn, "SELECT tokens FROM user WHERE id = $id;");
$_SESSION["user"]["tokens"] = $updateToken->fetch_assoc()["tokens"];



$result = mysqli_query($conn, $qry);

if ($result->num_rows > 0): ?>
  <div class="mx-5">
    <?php while ($row = $result->fetch_assoc()):
      $username = $row["username"];
      $don_id = $row["id"];
      $item_name = $row["item_name"];
      $category_id = $row["category_id"];
      $quantity = $row["quantity"];
      $description = $row["description"];
      ?>
      <div class=" card my-3" data-bs-theme="dark">
        <div class="row g-0">
          <div class="col-md-4">
            <img src="<?= $row["image"] ?>" alt="..." class="img-thumbnail"
              style="width: 100%; height: 200px; object-fit: cover;">
          </div>
          <div class="position-relative col-md-8">
            <div class=" card-body">
              <h3 class="card-title m-0">
                <?= $row["item_name"] ?>
              </h3>
              <span class="card-text text-secondary">
                From:
                <?= $row["username"] ?>
              </span>
              <p class="card-text m-0">
                Category:
                <?= $row["category_name"] ?>
              </p>
              <p class="card-text m-0">
                Quantity:
                <?= $row["quantity"] ?>
              </p>
              <p class="card-text m-0">
                Value:
                <?= $row["value"] ?>
              </p>

              <div id="modify-buttons">
                <div class="position-absolute top-0 end-0 p-3">
                  <form action="account.php" method="post">
                    <button id="<?= $username . $don_id ?>" type="button" class="btn btn-primary btn-sm"
                      data-bs-toggle="modal" data-bs-target="#editModal"
                      data-don-values="<?= "$item_name,$category_id,$quantity,$description" ?>"><i
                        class="fa-regular fa-pen-to-square"></i></button>
                    <input type="number" name="don_id" value="<?= $row["id"] ?>" hidden>
                    <button name="delete_<?= $username . $don_id ?>" id="del_<?= $username . $don_id ?>" type="submit"
                      class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                  </form>
                  <?php
                  // this is so unnecessary....
                  if ($row["is_checked"] == 1) {
                    $script = "<script defer>";
                    $script .= "document.getElementById('$username$don_id').setAttribute('disabled','true');";
                    $script .= "document.getElementById('del_$username$don_id').setAttribute('disabled','true');";
                    $script .= "</script>";
                    echo $script;
                  } else {
                    $script = "<script >";
                    $script .= "document.getElementById('$username$don_id').removeAttribute('disabled');";
                    $script .= "document.getElementById('del_$username$don_id').removeAttribute('disabled');";
                    $script .= "</script>";
                    echo $script;
                  }
                  ?>
                </div>
              </div>

              <div class="position-absolute bottom-0 end-0 ">
                <small class="card-subtitle m-3">
                  <?= $row["date_time"] ?>
                </small>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        data-bs-theme="dark">
        <div class="modal-dialog">
          <div class="modal-content ">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Information</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="account.php" method="POST" data-bs-theme="light">
                <div class="mb-3">
                  <label class="col-form-label">Item Name:</label>
                  <input type="text" class="form-control" id="item_name" name="item_name">
                </div>
                <div class="mb-3">
                  <label class="form-label">Category</label>
                  <select class="form-control" name="category">
                    <option value="" disabled hidden>Choose here</option>
                    <option value="1">computers</option>
                    <option value="2">phones</option>
                    <option value="3">television</option>
                    <option value="4">appliances</option>
                    <option value="5">batteries</option>
                    <option value="6">others</option>
                  </select>
                </div>
                <div class="mb-3">
                  <label class="col-form-label">Quantity:</label>
                  <input type="number" min="1" class="form-control" id="quantity" name="quantity"></input>
                </div>
                <div class="mb-3">
                  <label class="col-form-label">Description:</label>
                  <textarea class="form-control" id="description" name="description"></textarea>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <input type="number" name="edit_id" value="<?= $row["id"] ?>" hidden>
              <button name="<?= $row["username"] . $row["id"] ?>" type="submit" class="btn btn-primary">Edit
                changes</button>
            </div>
            </form>
          </div>
        </div>
      </div>

      <?php

    endwhile; ?>

  <?php else:
  echo "<h3><center class='title'>nothing yet...</center><h3>";
endif;
// }

?>
</div>
<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the form data
  $result = mysqli_query($conn, $qry);
  if ($result->num_rows > 0):
    while ($row = $result->fetch_assoc()):
      $form_name = $row["username"] . $row["id"];
      debug("b");
      echo $form_name;
      if (isset($_POST[$form_name])) {
        debug("a");

        $edit_id = cleanInput($_POST['edit_id']);
        $itemName = cleanInput($_POST['item_name']);
        $category = cleanInput($_POST['category']);
        $quantity = cleanInput($_POST['quantity']);
        $description = cleanInput($_POST['description']);

        echo $itemName;
        echo $category;
        // Perform any necessary data validation or sanitization
        // ...

        // Update the data in the database
        $query = "UPDATE donation SET item_name = ?, category_id = ?, quantity = ?, description = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("siisi", $itemName, $category, $quantity, $description, $edit_id);

        if ($stmt->execute()) {
          // Update successful
          debug("success");

          echo "<script>window.location = 'account.php'</script>";
          echo "Data updated successfully in the database.";
        } else {
          // Update failed
          debug("error");
          echo "Error updating data in the database: " . $stmt->error;
        }

        // Close the statement and database connection
        break;
      }

      if (isset($_POST["delete_$form_name"])) {
        $id = $_POST["don_id"];
        $query = "DELETE FROM donation WHERE id = $id";
        $res = mysqli_query($conn, $query);
        if ($res) {

          echo "<script>window.location = 'account.php'</script>";
        }
      }
    endwhile;
    $stmt->close();
    $conn->close();
  endif;
}
echo footer();