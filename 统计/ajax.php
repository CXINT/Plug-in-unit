<?php


		$url = $_GET["url"];
		if($url==''){echo '�Ƿ�����';exit;}
		$ip = $_SERVER["REMOTE_ADDR"];
		$adddate=date("Y-m-d H:i:s ");
		 $conn=mysql_connect("127.0.0.1","root","数据库密码") or die("���ݿ�����ʧ��".mysql_error());
		 mysql_select_db("tongji",$conn) or die("�Ҳ������ݿ�".mysql_error());
		 mysql_query("set character set utf8");
		 mysql_query("set names utf8");
		 
		 
		$s="select * from tongji where url='$url';";
		$sqll=mysql_query($s);
		$result=mysql_fetch_array($sqll);
		//�ҵ�����url�͸���+1    �Ҳ����Ͳ������ݿ�Ĭ����1
		if($result){
			$str = "update tongji set num=num+1 where url = '$url'";
			mysql_query($str);
		}else{
			
			$str = "insert into tongji(url,ip,adddate) values ('$url','$ip','$adddate')";
			 mysql_query($str);
			
		}
		 
	
?>