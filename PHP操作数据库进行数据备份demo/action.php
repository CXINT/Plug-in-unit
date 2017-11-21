<?php
header("Content-Type: text/html;charset=utf-8");
require("conn.php");

if($_POST){
  $dbname = strtolower($_POST['dbname']);//把大小写转成小写
}
  
if(!mysql_select_db($dbname)){ //是否存在该数据库
 echo "不存在数据库:".$dbname.",请核对后再试！"."<a href='index.php' style='margin-left:10px;'>返回</a>";
 exit;
}
mysql_query("set names 'utf8'");
$mysql= "set charset utf8;\r\n";
$q1=mysql_query("show tables");
while($t=mysql_fetch_array($q1)){
  $table=$t[0];
  $q2=mysql_query("show create table `$table`");
  $sql=mysql_fetch_array($q2);
  $mysql.=$sql['Create Table'].";\r\n";
  $q3=mysql_query("select * from `$table`");
  while($data=mysql_fetch_assoc($q3)){
    $keys=array_keys($data);
    $keys=array_map('addslashes',$keys);
    $keys=join('`,`',$keys);
    $keys="`".$keys."`";
    $vals=array_values($data);
    $vals=array_map('addslashes',$vals);
    $vals=join("','",$vals);
    $vals="'".$vals."'";
    $mysql.="insert into `$table`($keys) values($vals);\r\n";
  }
}

$rdate=date("Ymd",time()); //文件名
 
if (!@file_exists($rdate)) mkdir($rdate);//创建目录
 
// $filename="data/".$dbname.date('Ymjgi').".sql";
$filename=$rdate."/".$dbname.".sql"; //存放路径，默认存放到项目最外层
$fp = fopen($filename,'w');
fputs($fp,$mysql);
fclose($fp);
echo $dbname.".sql数据备份成功"."<a href='index.php' style='margin-left:10px;font-weight:blod'>返回</a>";
?>