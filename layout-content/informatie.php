<?php $info = (isset($_GET['info']) ? $_GET['info'] : false); ?>
<div class="container-fluid bg-grey">
  <div class="container">
    <div class="row">
      <div class="col-2">
        <ul class="nav flex-column info-nav">
          <li class="nav-item <?php if ($info == 'info-1') echo 'active' ?>">
            <a class="nav-link" href="./index.php?content=informatie&info=info-1">Over afasie</a>
          </li>
          <li class="nav-item <?php if ($info == 'info-2') echo 'active' ?>">
            <a class="nav-link" href="./index.php?content=informatie&info=info-2">Geschiedenis</a>
          </li>
          <li class="nav-item <?php if ($info == 'info-3') echo 'active' ?>">
            <a class="nav-link" href="./index.php?content=informatie&info=info-3">Soorten afasie</a>
          </li>
          <li class="nav-item <?php if ($info == 'info-4') echo 'active' ?>">
            <a class="nav-link" href="./index.php?content=informatie&info=info-4">Tips</a>
          </li>
          <li class="nav-item <?php if ($info == 'info-5') echo 'active' ?>">
            <a class="nav-link" href="./index.php?content=informatie&info=info-5">Behandeling</a>
          </li>
        </ul>
      </div>
      <div class="col-10">
        <div class="jumbotron jumbotron-fluid p20">
          <div class="container">
            <?php
            if (isset($_GET["info"])) {
              include("./layout-content/informatie-content/" . $_GET["info"] . ".php");
            } 
             else {
              include("./layout-content/informatie-content/info-1.php");
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>