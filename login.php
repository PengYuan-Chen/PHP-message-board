<?php 
include("./connMysql.php");
session_start();

if(isset($_POST["username"])){
    $result=$db_link->query("SELECT * FROM admin");
    while($rows=$result->fetch_row()){
        if($rows[0]==$_POST["username"] && $rows[1]==$_POST["passwd"]){
            $_SESSION["check"]=1;
            header("Location:admin.php");
        }else{
            header("Location:index.php");
        }
    }
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
            margin: auto;
        }
        input[type="submit"],input[type="reset"],button{
            margin:5px 5px;    
            width:70px 
        }
        p{
            text-align: center;
            color: orangered;
        }
    </style>
</head>
<body>
<div>
    <img src="./images/board_r1_c1.jpg" >
    <a href="./index.php"><img src="./images/read.jpg" ></a>
    <a href="./post.php"><img src="./images/post.jpg"></a> 
    <img src="./images/board_r2_c1.jpg" >
    <p>登入管理</p>
    <form   method="POST" name="formpost">
        <table>
            <tr><td rowspan="0"><img src="./images/login.gif"  ></td></tr>
            <tr>
                <td>管理帳號</td><td><input type="text" name="username" ></td>    
            </tr>
            <tr>
                <td>管理密碼</td><td><input type="text" name="passwd" ></td>    
            </tr>
        </table>
        <table>
            <tr>
                <td><input type="submit" value="登入管理">
                <input type="button" value="回上一頁" onClick="window.history.back();" ></td>
            </tr>
        </table>        
        </form>
    
</div>
</body>
</html>