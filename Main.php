<?php
function writeMsg($id, $title)
{
  ?>
  <div class="card mx-5 my-3">
    <a href="product.php?id=<?= $id ?>" class="no-decoration card-block stretched-link">
      <div class="row g-0">
        <div class="col-md-4">
          <img src="<?php echo './blob/UM.png'; ?>" class="img-fluid rounded-start" alt="...">
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h5 class="card-title">
              <?php echo $title ?>
            </h5>
            <small class="card-text">
              id:
              <?php echo $id ?>
            </small>
            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional
              content.
              This content is a little bit longer.</p>
            <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
          </div>
        </div>
      </div>

    </a>
  </div>
  <?php
} ?>