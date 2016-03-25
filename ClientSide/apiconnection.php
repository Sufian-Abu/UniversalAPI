<?php
$host ='localhost';
$user = 'root';
$pass = '';
$mysql_db = "universalapi";
if(!@mysql_connect($host,$user,$pass)||!@mysql_select_db($mysql_db))
{
	echo "ki hoilo";
	die();
}

?>