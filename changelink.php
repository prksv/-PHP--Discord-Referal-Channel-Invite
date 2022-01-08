<?php
require 'mysql.php';

$link = $_POST['link'];

$config = R::findOne( 'config', 'id = 1');
$config->link = $link;
R::store($config);

  ?>