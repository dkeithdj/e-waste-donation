<?php
require_once 'utils.php';
echo head("Admin", "admin");
?>
<div style="color: white;">
  <h1>TODO for admin page</h1>
  <ul>
    <li>Designs <strong>card view</strong></li><br>
  </ul>
</div>
<div class="container">
  <!-- <div class="row px-1">
    <div class="stuff card center mb-2">
      <div class="col-lg-12 center">Total Donations</div>
      <div class="col-lg-12 center">
        <h1>25000</h1>
      </div>
    </div>
  </div> -->
  <div class="row row-gap-2 ">

    <form action="admin.php" class="row g-3" method="get">
      <?php
      $categories = array("Computers", "Mobile Phones", "Television", "Appliances", "Batteries", "Others");
      foreach ($categories as $category): ?>

        <div class="px-1" data-bs-theme="dark">
          <div class="card" style="height: 100%;">
            <!-- <img src="./blob/computer.jpg" alt="..." class="card-img-top" style="width: 200px; height: auto;"> -->
            <div class="card-body">
              <h5 class="card-title">
                <?= $category ?>
              </h5>
              <div class="form-floating mb-3">
                <input class="form-control" type="number" name="<?= $category ?>" min="0">
                <label class="form-label" for="token">Tokens</label>
                <input type="submit" value="Send">
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </form>


  </div>



</div>
</div>

<?php
echo footer();