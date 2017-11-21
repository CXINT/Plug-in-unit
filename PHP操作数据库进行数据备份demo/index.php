<!DOCTYPE html>
<html>
<head>
	<title>备份数据库</title>
	<meta charset="utf-8">
	<link href="https://cdn.bootcss.com/bootstrap/4.0.0-beta/css/bootstrap.css" rel="stylesheet">
</head>
<body>

<?php 
require("conn.php");
$mysql= "set charset utf8;\r\n";
$sql = "show databases";
$result=mysql_query($sql);
$count = mysql_num_rows($result);//查出数据库的数量和详细
 // echo "<p style="'background-color:white;'">数据库的数量:".$count."个;</p><br/>";
echo "服务器查询到的数据库的数量:<font style='font-weight:bold;'>".$count."个。</font><br/>";

$dbs = @mysql_list_dbs();
   echo "服务器上所有数据库名称: <br />";
   while (list($db) = mysql_fetch_row($dbs)) {
      echo "$db<br />";
   }
?>
<br/>
<br/>
 <h1><label class="col-sm-12 control-label">请填写需要备份的数据库</label></h1>
	<form class="form-horizontal col-md-6" action="action.php" method="post">
	  <div class="form-group">
	    <div class="col-sm-6">
	      <input type="text" class="form-control" name="dbname" placeholder="请输入数据库名称">
	    </div>
	  </div>
	  <div class="form-group">
	    <div class="col-sm-offset-2 col-sm-6">
	      <button type="submit" class="btn btn-default demo4">开始备份</button>
	    </div>
	  </div>
	</form>
</body>
</html>

