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
<div class="theme card">
  <div class="row">
    <div class="col">
      col1
    </div>
    <div class="col">
      col2
    </div>
  </div>
  <div class="card-body">
    Total Donations
  </div>
  <div class="card-body">
  </div>
</div>

<?php
echo footer();