<?php 
 
$db_link=new mysqli("localhost","root","a8041180411","phpboard");
if($db_link->connect_error!=""){
    echo "錯誤";
}else{
    $db_link->query("SET NAMES 'utf8'");
}