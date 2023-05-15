<?php
require_once 'utils.php';
echo head("Account", "account");

if (isset($_GET["id"])) {
  $id = $_GET["id"];
  $qry = "SELECT * FROM Activity_Proposal WHERE id=$id";

  $result = mysqli_query(connect(), $qry);

  $title = "";
  // donate count
  // e-waste type
  // 
  if ($result->num_rows > 0) {

    $data = mysqli_fetch_assoc($result);
  }
  mysqli_close(connect());
}

?>
<div class="row mx-5 adjust">
  <?php
  for ($i = 0; $i < 3; $i++): ?>

    <p>things that the user donated</p>
    <div class="card">
      <div class=" card-body">
        <div class="col">
          <img src="./blob/UM.png" alt="..." class="card-img-top" style="max-width: 5rem; height: auto;">
        </div>
        <div class="col">
          <h5 class="card-title">{TYPE}</h5>
          <h6 class="card-subtitle mb-2 text-body-secondary">{TIME}</h6>
          <p class="card-text">{AMOUNT}</p>
        </div>
      </div>
    </div>

    <?php
  endfor; ?>
</div>
<?php
echo footer();