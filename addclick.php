<?php
require 'mysql.php';

$blogger = $_POST['blogger'];

$blogger = R::findOne( 'bloggers', 'nickname ="'. $blogger.'"');
$blogger->clicks = $blogger->clicks + 1;
R::store($blogger);


  ?>