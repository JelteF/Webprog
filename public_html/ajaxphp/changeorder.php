<?php
//this script allows you to change the display order of posts
//it highlights the option that is currently set
$current = 'populair';
if (isset($_GET['order']))
  $current = $_GET['order'];

echo "<div class='row'>"
		."<div class='span8 offset2'>"
		."<p class='pull-right'>"
		."<b>Sorteer op: </b>";

$opties = array('populair','tijd','waardering');
for ($i = 0; $i < 3; $i++) {
  echo "<a ";
  if ($current == $opties[$i])
    echo "class='active' ";
  $url = $_GET;
  $url['order'] = $opties[$i];
  $url['page'] = 1;
  $url = "http://uvabook.nl/study.php?".http_build_query($url);
  echo "href='$url'>$opties[$i]</a>";
  if ($i < 2)
    echo ", ";
}

echo "  </p>"
		."  </div>"
		."  </div>"
		.""

  ?>
