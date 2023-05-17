<?php
require_once 'utils.php';
echo head("Admin", "admin");

$id = $_SESSION["user"]["id"];

$qry = "SELECT d.*, u.tokens, u.username, c.category_name ";
$qry .= "FROM donation d ";
$qry .= "JOIN user u ON d.user_id = u.id ";
$qry .= "JOIN category c ON d.category_id = c.id ";
$qry .= "WHERE is_checked = 0 ";
$qry .= "ORDER BY d.date_time;";
$result = mysqli_query($conn, $qry);


if ($result->num_rows > 0): ?>
  <div class="mx-5">
    <?php while ($row = $result->fetch_assoc()):
      $username = $row["username"];
      $id = $row["id"];
      ?>
      <div class="card my-3 nav-color" data-bs-theme="dark">
        <div class="row g-0">
          <div class="col-md-4">
            <img src="<?= $row["image"] ?>" alt="..." class="img-thumbnail"
              style="width: 100%; height: 200px; object-fit: cover;">
          </div>
          <div class="position-relative col-md-8">
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

$result = mysqli_query($conn, $qry);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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