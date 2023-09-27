<?php
include("./connMysql.php");
if(isset($_GET["logout"])){
    if($_GET["logout"]==1){
        session_unset();
    }
}

$pagerow_records=5;
$num_pages=1;
if(isset($_GET['page'])){
    $num_pages=$_GET['page'];
}
$startrow_records=($num_pages-1)*$pagerow_records;
$result=$db_link->query("SELECT * FROM board LIMIT {$startrow_records},{$pagerow_records}");
$all_result=$db_link->query("SELECT * FROM board");
$sub_result=$db_link->query("SELECT boardsubject FROM board LIMIT {$startrow_records},{$pagerow_records}");
$total_records=$all_result->num_rows;
$total_pages=ceil($total_records/$pagerow_records);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        
        .main{
            width: 750px;
            margin: auto;
            background-color:lightblue;
            border-radius: 10px;
        }
        .name{
            margin-top: 0;
            margin-left: 5px;
        }
        .ig{
            margin-top: 20px;
        }
        table{
            padding: 30px;
        }
        .cont{
            margin-top: -10px;
        }
        .cont{
            font-size:smaller;
        }
        .name{
            text-align: center;
            font-size:smaller;
        }
        .num{
            display: inline;
        }
        .conttime{
            font-size:smaller; 
            width: 200px;
            margin-left: 50px;
            color: gray;
        }
        .ig,.name{
            margin-right: 20px;
        }
        .tab2{
            margin-left: auto;
            padding: 0;
        }
        .img-section{
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="main">
        <div class="img-section">
            <img src="./images/board_r1_c1.jpg" >
            <img src="./images/read.jpg" >
            <a href="./post.php"><img src="./images/post.jpg"></a>
            <img src="./images/board_r2_c1.jpg" >
        </div>
        <table>
        <?php
        while($rows=$result->fetch_assoc()){
            foreach($rows as $itm=>$val){
                if($itm=="boardname"){        
                    if($rows["boardsex"]=="男"){
                        ?>
                        <tr><td rowspan="2"><img class="ig" src="./images/male.gif"><p class="name"><?php echo $rows[$itm] ?></p></td>
                        <?php
                    }else{
                        ?>
                        <tr><td rowspan="2"><img class="ig" src="./images/female.gif"><p class="name"><?php echo $rows[$itm] ?></p></td>
                        <?php                    
                    }
                }
                elseif($itm=="boardsubject"){
                    ?>
                    <td><p class="sub"><?php echo "<hr>[".$rows["boardid"]."]".$rows[$itm]  ?></p></td></tr>   
                    <?php
                }
                elseif($itm=="boardcontent"){
                    ?>
                    <tr>
                        <td><p class="cont"><?php echo $rows[$itm] ?></p></td>
                        <td><p class="conttime"><?php echo $rows["boardtime"] ?></p></td>
                    </tr>
                    <?php
                }
                
            }
        } 

        ?>
        </table>         
        <?php echo "<hr>";?> 
        
        <table class="tab2">
            <tr>
                
                <?php
                if($num_pages==1){
                ?>
                    <td colspan="2"><a href="./index.php?page=<?php echo $num_pages+1 ?>">下一頁</a></td>
                    <td colspan="2"><a href="./index.php?page=<?php echo $total_pages ?>">最末頁</a></td>
                <?php
                }elseif($num_pages==$total_pages){
                ?>
                    <td><a href="./index.php?page=<?php echo 1 ?>">第一頁</a></td>
                    <td><a href="./index.php?page=<?php echo $num_pages-1 ?>">上一頁</a></td>
                <?php
                }else{
                ?>
                    <td><a href="./index.php?page=<?php echo $num_pages-1 ?>">上一頁</a></td>
                    <td><a href="./index.php?page=<?php echo $num_pages+1 ?>">下一頁</a></td>
                <?php
                }
                ?>
            </tr>
        </table>
        <p class="how">資料筆數:<?php echo  $total_records ?></p>
        <a href="./login.php"><img src="./images/login.jpg"></a>
    </div>
</body>
</html>

