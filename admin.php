<?php
require_once 'utils.php';
echo head("Admin", "admin");
?>
<div style="color: white;">
  <h1>TODO for admin page</h1>
  <ul>
    <li>Statistics view of donations</li><br>
    <li>Designs <strong>card view</strong></li><br>
    <li>Get count of donations PER TYPE and PER MONTH and ANNUAL</li><br>
  </ul>
</div>
<div>card for overall donations</div>
<div>card for specific types (multiple cards)</div>
<div class="container">
  <div class="row px-1">
    <div class="stuff card center mb-2">
      <div class="col-lg-12 center">Total Donations</div>
      <div class="col-lg-12 center">
        <h1>25000</h1>
      </div>
    </div>
  </div>
  <div class="row row-gap-2 ">

    <?php
    $categories = array("Computers", "Mobile Phones", "Television", "Appliances", "Batteries", "Others");
    foreach ($categories as $category): ?>
      <div class="col-md-4 px-1">
        <div class="card" style="height: 100%;">
          <img src="./blob/computer.jpg" alt="..." class="card-img-top" style="width: 200px; height: auto;">
          <div class="card-body">
            <h5 class="card-title">
              <?= $category ?>
            </h5>
            <p class="card-text" style="color: black;">
              2222
            </p>
          </div>
        </div>
      </div>
    <?php endforeach; ?>


  </div>



</div>
</div>

<?php
echo footer();