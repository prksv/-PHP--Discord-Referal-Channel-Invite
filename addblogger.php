<?php
require 'mysql.php';

$nickname = $_POST['blogger'];
$newBlogger = R::dispense('bloggers');
$newBlogger->nickname = $nickname;
$newBlogger->clicks = 0;
R::store($newBlogger);

$blogger = R::findOne( 'bloggers', 'nickname ="'. $nickname.'"');
echo $blogger->id;
  ?>