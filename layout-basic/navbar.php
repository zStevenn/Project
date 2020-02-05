<?php $content = (isset($_GET['content']) ? $_GET['content'] : false); ?>
<div class="upper-navbar">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <a href="index.php?content=inloggen" class="float-right acc-link">Mijn account</a>
      </div>
    </div>
  </div>
</div>
<nav class="navbar navbar-expand-lg navbar-light">
  <div class="container">
    <div class="row">
      <a class="navbar-brand" href="index.php?content=home"><img src="./img/homelogo.png" alt="Homepage Logo"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="<?php if ($content == 'home') echo 'active' ?>">
            <a href="./index.php?content=home">Home</a></li>
          <li class="<?php if ($content == 'informatie') echo 'active' ?>">
            <a href="index.php?content=informatie">Informatie</a></li>
          <li class="<?php if ($content == 'spel') echo 'active' ?>">
            <a href="index.php?content=spel">Spel</a></li>
          <li class="<?php if ($content == 'contact') echo 'active' ?>">
            <a href="index.php?content=contact">Contact</a></li>
          <li class="<?php if ($content == 'highscores') echo 'active' ?>">
            <a href="index.php?content=highscores">Highscores</a></li>
        </ul>
      </div>
    </div>
  </div>
</nav>