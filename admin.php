<?php
require_once 'utils.php';
require_once 'modals.php';
echo head("Admin", "admin");

$id = $_SESSION["user"]["id"];
$filter = "0 OR 1";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  if (isset($_GET["filter"])) {
    if ($_GET["filter"] == 0) {
      $filter = "0";
    } elseif ($_GET["filter"] == 1) {
      $filter = "1";
    } else {
      $filter = "0 OR 1";
    }
  }
}

$qry = "SELECT d.*, u.tokens, u.username, c.category_name ";
$qry .= "FROM donation d ";
$qry .= "JOIN user u ON d.user_id = u.id ";
$qry .= "JOIN category c ON d.category_id = c.id ";
$qry .= "WHERE is_checked = $filter ";
$qry .= "ORDER BY d.date_time DESC;";
$result = mysqli_query($conn, $qry);

if ($result->num_rows > 0): ?>
  <div class="mx-5">
    <form class="row mt-3" action="admin.php" method="get">
      <div class="col-md-10">
        <select name="filter" class="form-select" data-bs-theme="light">
          <option value="0">Unchecked</option>
          <option value="1">Checked</option>
          <option value="2">All</option>
        </select>
      </div>
      <div class="col-md-2 d-grid gap-0 px-1">
        <button type="submit" class="btn btn-success me-md-2">Filter</button>
      </div>
    </form>
    <?php while ($row = $result->fetch_assoc()):
      $username = $row["username"];
      $item_name = $row["item_name"];
      $description = $row["description"];
      $id = $row["id"];
      ?>
      <div class="card my-3 nav-color" data-bs-theme="dark">
        <div class="row g-0">
          <div class="col-md-4">
            <img src="<?= $row["image"] ?>" alt="..." class="img-thumbnail"
              style="width: 100%; height: 200px; object-fit: cover;">
          </div>
          <div class="position-relative col-md-8">
            <div class="position-absolute top-0 end-0 p-3">
              <button data-don-desc="<?= "$item_name,$description" ?>" data-bs-target="#readMoreModal"
                data-bs-toggle="modal" type="button" class="btn btn-success btn-sm"><i
                  class="fa-solid fa-book"></i></button>
            </div>

            <div class="card-body">
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
              <form action="admin.php" method="POST">
                <div class="input-group input-group-sm mb-3">
                  <span class="input-group-text" id="inputGroup-sizing-sm">Value</span>
                  <input name="<?= "value_" . $row["username"] . $row["id"] ?>" type="number" min="1" class="form-control"
                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value="<?= $row["value"] ?>">
                  <button class="btn btn-outline-warning" type="submit"
                    name="<?= $row["username"] . $row["id"] ?>">Send</button>

                  <?php
                  // this is so unnecessary....
                  if ($row["is_checked"] == 1) {
                    $script = "<script defer>";
                    $script .= "document.getElementsByName('value_$username$id')[0].setAttribute('disabled','');";
                    $script .= "document.getElementsByName('$username$id')[0].setAttribute('disabled','');";
                    $script .= "</script>";
                    echo $script;
                  } else {
                    $script = "<script defer>";
                    $script .= "document.getElementsByName('value_$username$id')[0].removeAttribute('disabled');";
                    $script .= "document.getElementsByName('$username$id')[0].removeAttribute('disabled');";
                    $script .= "</script>";
                    echo $script;
                  }
                  ?>
              </form>
              <!-- <input type="submit" value="Send"> -->
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
  <?php endwhile;
else:
  echo "<h3><center class='title'>nothing yet...</center><h3>";
endif;

?>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $result = mysqli_query($conn, $qry);
  if ($result->num_rows > 0):
    while ($row = $result->fetch_assoc()):
      $form_name = $row["username"] . $row["id"];
      if (isset($_POST[$form_name])) {
        $value = $_POST["value_" . $row["username"] . $row["id"]];

        echo $value . " " . $row["id"];
        $stmt = $conn->prepare("UPDATE donation SET value = ?, is_checked = 1 WHERE id = ?");
        $stmt->bind_param("ii", $value, $row["id"]);

        if ($stmt->execute()) {
          $sum_token = $row["tokens"] + $value;
          $add_token = $conn->prepare("UPDATE user SET tokens = ? WHERE id = ?");
          $add_token->bind_param("ii", $sum_token, $row["user_id"]);
          $add_token->execute();
          echo "<script>window.location = 'admin.php'</script>";
        }
        break;
      }
    endwhile;
  endif;

}

mysqli_close($conn);
echo footer();