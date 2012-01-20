<?php $page_name = $_SERVER['PHP_SELF']; ?>
    <div class="topbanner">
      <img src="images/logo.jpg" alt="Universiteit van Amsterdam" />
    </div>
    <div class="banner">
      <img src="images/banner.jpg" alt="UvAbook" />
    </div>
    <div class="topbar">
      <div class="fill">
        <div class="container">
          <a class="brand" href="http://www.uvabook.nl/">UvAbook</a>
          <ul class="nav">
            <li class="<?php if($page_name=="/index.php") echo "active"; ?>"><a href="index.php">Home</a></li>
            <li class="<?php if($page_name=="/opleidingen.php") echo "active"; ?>"><a href="opleidingen.php">Opleidingen</a></li>
            <li class="<?php if($page_name=="/contact.php") echo "active"; ?>"><a href="contact.php">Contact</a></li>
            <li class="<?php if($page_name=="/faq.php") echo "active"; ?>"><a href="faq.php">FAQ</a></li>
          </ul>
          <form action="" class="pull-left">
          </form>
          <form action="" class="pull-right">
            <input class="input-large" type="text" placeholder="Zoek een opleiding">
            <button class="btn" type="submit">Login</button>
          </form>
          <form action="https://secure.uva.nl/cas/login?service=http://uvabook.nl" method="POST">
    		<input type="submit" value="inloggen">
		  </form>
        </div>
      </div>
    </div>
