<?php 
header("Content-Type: text/html;charset=utf-8");
$host = 'localhost';
$user = 'root';
$password = 'root';
if(!@mysql_connect($host,$user,$password)){ //连接mysql数据库
	echo '数据库连接失败，请核对后再试';exit;
}

mysql_query("set character set utf8");
?>