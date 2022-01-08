<?php
require 'mysql.php';

$id = $_POST['blogger'];

$blogger = R::findOne( 'bloggers', 'id ="'. $id.'"');
R::trash($blogger);

  ?>