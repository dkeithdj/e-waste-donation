<?php
// modals
function login_error($message)
{
  ob_start(); ?>

  <div class="modal fade" id="loginErrorModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    data-bs-theme="dark">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Wrong Credentials</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="modal-text">
            <?= $message ?>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <?php
  return ob_get_clean();
}

// function read_more($title, $username, $category, $quantity, $value, $description, $date)
// {
//   ob_start(); ?>

<div class="modal fade" id="readMoreModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
  data-bs-theme="dark">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h6>Description</h6>
        <div class="modal-text">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php
// return ob_get_clean();
// }
?>