<?php 
include("./connMysql.php");
if(!isset($_GET['id'])){
    header("Location:index.php");
}
$sql_query1="SELECT * FROM board WHERE boardid=$_GET[id]";
$result=$db_link->query($sql_query1);
if(isset($_POST["sub"])){
    echo 1;
    $sql_query="DELETE FROM board WHERE boardid=?";
    $stmt=$db_link->prepare($sql_query);
    $stmt->bind_param("i",$_GET['id']);
    $stmt->execute();
    $stmt->close();
    $db_link->close();
    header("Location:admin.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        div{
            width: 750px;
            margin: auto;
            background-color:lightblue;
            border-radius: 10px;
            height: 350px;
        }
        textarea{
            margin-left:20px;
        }
        table{
           margin-left: 100px;
        }
        input[type="submit"],input[type="reset"],button{
            margin:5px 5px;    
            width:70px 
        }
        p{
            color:orangered;
            margin-left: 100px;
        }
        h4{
            display: inline;
        }
        .tab2{
            margin: auto;
        }
    </style>
</head>
<body>
<div>
    <img src="./images/board_r1_c1.jpg" >
    <img src="./images/board_r2_c1.jpg" >
    <p>刪除訪客留言資料</p>
    <form action="#" method="POST" name="formpost">
        <table> 
            <tr>           
            <?php
            while($rows=$result->fetch_assoc()){
            ?>
                <td><h4>標題  : </h4><?php echo $rows["boardsubject"] ?>
                    <h4>姓名  : </h4><?php echo $rows["boardname"] ?>
                    <h4>姓別  : </h4><?php echo $rows["boardsex"] ?>
                </td>
            </tr>
            <tr>
                <td><h4>郵件 : </h4><?php echo $rows["boardmail"] ?>
                    <h4>網站 : </h4><?php echo $rows["boardweb"] ?>
                </td>
            </tr>
            <tr>
                <td><?php echo $rows["boardcontent"] ?></td>
            </tr>
            <?php
            }
            ?>
        </table>
        <table class="tab2">
            <tr>
                <td><input type="submit" value="刪除" name="sub">
                <input type="button" value="上一頁" onClick="window.history.back();" ></td>
            </tr>
        </table>        
    </form>
</div>
</body>
</html>