<?php
mysql_connect("localhost", "user", "");
mysql_select_db("Notes");

session_start();

$salt1 = 'my!';
$salt2 = '!your.';

?>