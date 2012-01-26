<?php
$id = $_GET['id'];
$nrOfPosts = 5;
$query = mysql_query("SELECT COUNT(id) FROM posts WHERE studie='$id'");
while ($row =  mysql_fetch_array($query))
  $count = $row['COUNT(id)'];

$page = 1;
if (isset($_GET['page'])) $page = $_GET['page'];
$last_page = ceil($count/$nrOfPosts);
$self = "http://uvabook.nl/study.php";

echo "<div class='row'>"
    ."<div class='span8 offset2'>"
    ."<div class='pagination'>"
    ."<ul>"
    ."<li class='prev";
if ($page == 1)
  echo " disabled";
$url = changeQuery('page', 1);
echo "'><a href='$url'>&larr;&larr;</a></li>"
    ."<li class='prev";
if ($page == 1)
  echo " disabled";
$url = changeQuery('page', $page - 1);
echo "'><a href='$url'>&larr;</a></li>";

for ($i = $page-3; $i < $page+4; $i++) {
  $url = changeQuery('page', $i);
  if ($i < 1 || $i > $last_page)
    echo "<li class='disabled'><a href='#'>.</a></li>";
  elseif ($i == $page)
    echo "<li class='active'><a href='#'>$page</a></li>";
  else
    echo "<li><a href='$url'>$i</a></li>";
}

echo "<li class='";
if ($page == $last_page)
  echo " disabled";
$url = changeQuery('page', $page+1);
echo "'><a href='$url'>&rarr;</a></li>"
    ."<li class='next";
if ($page == $last_page)
  echo " disabled";
$url = changeQuery('page', $last_page);
echo "'><a href='$url'>&rarr;&rarr;</a></li>"
    ."</ul>"
    ."</div>"
    ."</div>"
    ."</div>";

function changeQuery($field, $value) {
  $args = $_GET;
  $args[$field] = $value;
  return "http://uvabook.nl/study.php?".http_build_query($args);
}
?>
