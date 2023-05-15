<?php
require_once './utils.php';
require("Main.php");
echo head('Home', 'index');
// $sql = "SELECT * FROM Activity_Proposal";
// $result = mysqli_query(connect(), $sql);

// if ($result->num_rows > 0):
//   while ($row = mysqli_fetch_assoc($result)):
//     writeMsg($row["id"], $row["title"]);
//   endwhile;
// endif;
// mysqli_close(connect()) 
?>





<div id="the-facts" class="area adjust">
  <div style="position: relative;" class="left-p">
    <section class="hidden from-left">
      <h1>E - Donor</h1>
      <p>Donate now!</p>
    </section>
  </div>
  <div class="right-p">
    <section class="hidden from-right">
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem nam suscipit possimus nihil? Ut quia
        rem
        maxime dolore perferendis, dolorem sit dolor libero iure laudantium quo alias commodi, recusandae quam.</p>
    </section>
  </div>
</div>


<section id="the-information" class="hidden from-left">
  <h1>Having</h1>
  <p>animations</p>
</section>


<section id="faq">
  <h1>Frequently asked questions</h1>
  <p class="iter hidden from-left">1. Lorem ipsum dolor sit amet consectetur adipisicing
    elit. Illum tempore mollitia
    laboriosam, a rem quos pariatur nesciunt ullam nam incidunt voluptatibus ducimus minus laudantium autem, culpa
    sint
    at perferendis atque!</p>
  <p class="iter hidden from-left">2. Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati provident
    quidem eum asperiores, doloribus expedita consectetur eligendi esse debitis assumenda quia? Ducimus expedita sit
    placeat ab dolores architecto quas. Nisi.</p>
  <p class="iter hidden from-left">3. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Consectetur
    asperiores
    veritatis, maxime impedit at, error earum dicta vitae quasi non odit adipisci ratione voluptas cumque atque
    officia
    vero, amet alias!</p>
</section>

<section id="donate" class="hidden from-left">
  <h1>Donate here 🏥</h1>
  <!-- data-bs-toggle="modal" data-bs-target="#exampleModal" -->
  <button onclick="document.location.href = 'donate.php'" class="btn btn-warning">Herer</button>
  <!-- <p>theses links</p> -->
</section>

<section id="contact" style="min-height: 50vh;">
  <h1>contact</h1>
  <p><small>@ 2023</small></p>
</section>


<div style="position: relative;">
  <div style="z-index: 11; position: fixed; right: 10px; bottom: 20px;">
    <button onclick="topFunction()" id="toTop" title="Go to top">Top</button>

  </div>
</div>
<?php
echo footer();