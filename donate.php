<?php
require_once 'utils.php';
echo head("Donate", "donate");
?>
<h1>
  <center class="title">Donate</center>
</h1>

<div class="container">
  <div class="row row-gap-2">

    <form action="donate.php" class="row g-3" method="GET">

      <div class="col-md-6">
        <label class="form-label" for="item_name">Item Name</label>
        <input class="form-control" type="text" id="item_name" name="item_name" required>
      </div>

      <div class="col-md-6">
        <label class="form-label" for="category">Category</label>
        <select class="form-control" id="category" name="dropdown">
          <option value="computers" selected>computers</option>
          <option value="phones">phones</option>
          <option value="television">television</option>
          <option value="appliances">appliances</option>
          <option value="batteries">batteries</option>
          <option value="others">others</option>
        </select>
      </div>

      <div class="col-md-12">
        <label class="form-label" for="description">Description</label>
        <input class="form-control" type="text" id="description" name="description" required>
      </div>

      <div class="col-md-6">
        <label class="form-label" for="image">Image</label>
        <input class="form-control" type="file" id="image" name="image">
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
echo footer();