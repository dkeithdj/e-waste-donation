<?php
require_once 'utils.php';
echo head("Donate", "donate");
?>
<h1>
  <center class="title">Donate</center>
</h1>

<div class="container">
  <div class="row row-gap-2">
    <h4>Categories</h4>

    <form action="donate.php" method="post">



    </form>
    <?php
    $categories = array("computers", "phones", "television", "appliances", "batteries", "others");
    foreach ($categories as $category): ?>
      <div class="col-md-4 px-1">
        <div class="card rounded-pill" style="height: 100%;">
          <div class="card-body">
            <h5 class="card-title p-0 m-0 text-center">
              <?= $category ?>
            </h5>
            <input type="number" name="<?= $category ?>" id="<?= $category ?>">
          </div>
        </div>
      </div>
    <?php endforeach; ?>


  </div>
</div>

<div>
  <button onclick="displayInput()" class="click-cat">aa</button>
</div>
<?php
echo footer();