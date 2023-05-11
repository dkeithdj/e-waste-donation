<?php
require_once 'utils.php';
echo head("Product", "product");

if (isset($_GET["id"])) {
  $id = $_GET["id"];
  $qry = "SELECT * FROM Activity_Proposal WHERE id=$id";

  $result = mysqli_query(connect(), $qry);

  $title = "";
  if ($result->num_rows > 0) {

    $data = mysqli_fetch_assoc($result);
  }
  mysqli_close(connect());
} ?>

<section class="mx-5">
  <div class="row g-3">
    <div class="col-md-9">

      <iframe src="./ACM-ICPC-Manila-2017-Problem-Set.pdf" width="100%" height="900px"></iframe>
    </div>
    <div class="col-md-3">
      <div class="row g-3">
        <h1>Product</h1>
      </div>
      <div class="row g-3">
        <h2>
          <?= $data["title"] ?>
        </h2>
      </div>
      <div class="row g-3">
        <h3>
          submission date:
          <?= $data["submission_date"] ?>
        </h3>
      </div>
    </div>
  </div>
</section>

<?php
echo footer();