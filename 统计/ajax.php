<?php
$url = $_GET["url"];
if($url==''){echo '非法请求';exit;}
$ip = $_SERVER["REMOTE_ADDR"];
$adddate=date("Y-m-d H:i:s ");
$conn=mysql_connect("127.0.0.1","root","数据库密码") or die("数据库连接失败".mysql_error());
mysql_select_db("tongji",$conn) or die("找不到数据库".mysql_error());
mysql_query("set character set utf8");
mysql_query("set names utf8");
		 
		 
$s="select * from tongji where url='$url';";
$sqll=mysql_query($s);
$result=mysql_fetch_array($sqll);
//找到这条url就更新+1    找不到就插入数据库默认是1
if($result){
    $str = "update tongji set num=num+1 where url = '$url'";
    mysql_query($str);
}else{
    $str = "insert into tongji(url,ip,adddate) values ('$url','$ip','$adddate')";
    mysql_query($str);
}
		 
	
?>