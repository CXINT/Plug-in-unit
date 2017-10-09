<?php
//排除重复并重置序号
ini_set("display_errors","Off");
error_reporting(E_ALL^E_NOTICE^E_WARNING);
header("Content-type: text/html; charset=utf-8");
//数据库配置开始
$host='localhost'; //数据库地址
$user='root';//数据库账号
$pass='root';//数据库密码
$db='brand';//数据库
$tab='brand_enewsmember';//数据表
//数据库配置结束
$pdo = new PDO('mysql:host='.$host.';dbname='.$db, $user, $pass);
$pdo -> query("SET NAMES utf8");
 
//查询重复数据列表
//select ucard,count(*) as count from dianka group by ucard having count>1; 
 
$type = isset($_GET['type'])? strtolower($_GET['type']) : ''; 
   
if(!in_array($type, array('cha','gai'))){ 
  exit('<a href="?type=cha">列出重复数据</a> <a href="?type=gai&go=load">批量并重置</a>'); 
}
 
switch($type){ 
    //列出重复数
    case 'cha':
        echo '以下为查询到重复卡号列表：<a href="?type=gai&go=load">[进行批量重置]</a> <a href="?type=index">[返回]</a><br><br>';
        $rs = $pdo -> query("select ucard,count(*) as count from ".$tab." group by ucard having count>1" );
        //显示数量
        if($_GET['row']==''){
        $hang = $rs->fetchAll();
        if($_GET['test']=='cha' && count($hang)>0){
            $tishi='，如果还有重复，请再次点击↑重新进行批量重置。';
        }else{
            $tishi='';
        }
        echo '总计重复:'.count($hang).'条数据'.$tishi.'<br>';
        echo '<a href="?type=cha&row=list">[列出所有重复数据]</a>:(如果数据多可能会卡)<br>';
        //列出重复数据
        }else{
            echo '<a href="?type=cha">[返回上一步]</a><br>';
        while($row = $rs -> fetch()){
            echo '卡号：'.$row['ucard'].' 重复数量'.$row['count'].'<br>';
        }
             
        }
    break;
    //修改重复并重置
    case 'gai':
        if($_GET['go']=='load'){
        echo '正在重置，请稍等！';
        echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=?type=gai&go=gai"/>';
        }elseif($_GET['go']=='gai'){
        $rs = $pdo -> query("select ucard,count(*) as count from ".$tab." group by ucard having count>1" );
        while($row = $rs -> fetch()){
            //分别读取列表
            $grs = $pdo -> query("SELECT * from ".$tab." WHERE ucard='".$row['ucard']."'"); 
            $i=10000000;
            while($grow = $grs -> fetch()){
                $kuserid=substr(time(),-8);//获取时间戳后8位
                $count=$row['count'];
                $ucard='7'.($i+rand(0,9999999));
                $sql="UPDATE  ".$tab." SET  `ucard` =  '".$ucard."' WHERE userid =".$grow['userid'];
                //echo $sql;
                if($pdo->exec($sql)){
                    $num++;
                }
            }
        }
        if($num>0){
            echo '成功重置了：'.$num.'次数据 <a href="?type=cha&test=cha">[再次查询重复数据]</a> <a href="?type=index">[返回]</a>';
        }else{
            echo '没有需要重置的数据！<a href="?type=index">[返回]</a>';
        }
        }
    break;
}
 
?>