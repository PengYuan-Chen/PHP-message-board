<?php 
include("./connMysql.php");
if(!isset($_GET['id'])){
    header("Location:index.php");
}
$sql_query1="SELECT * FROM board WHERE boardid=$_GET[id]";
$result=$db_link->query($sql_query1);
if(isset($_POST["boardsubject"]) && $_POST["boardsubject"]!="" && $_POST["boardname"]!="" && $_POST["boardcontent"]!=""){
    $sql_query="UPDATE board SET boardsubject=?,boardname=?,boardsex=?,boardmail=?,boardweb=?,boardcontent=?,boardtime=?
    WHERE boardid=$_GET[id]";
    $stmt=$db_link->prepare($sql_query);
    $stmt->bind_param("sssssss",$_POST["boardsubject"],$_POST["boardname"],$_POST["boardsex"],$_POST["boardmail"],$_POST["boardweb"],$_POST["boardcontent"],date("Y-m-d H:i:s"));
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
            margin: auto;
        }
        input[type="submit"],input[type="reset"],button{
            margin:5px 5px;    
            width:70px 
        }
        p{
            color:orangered;
            margin-left: 100px;
        }
    </style>
    <script>
        function checkform(){
            if(document.formpost.boardsubject.value==""){
                alert("填寫標題");
                document.formpost.boardsubject.focus();  
                return false;
            }
            if(document.formpost.boardname.value==""){
                alert("填寫姓名");
                document.formpost.boardname.focus(); 
                return false;
            }
            if(document.formpost.boardcontent.value==""){
                alert("填寫留言內容");
                document.formpost.boardcontent.focus(); 
                return false;
            }
        }
    </script>
</head>
<body>
<div>
    <img src="./images/board_r1_c1.jpg" >
    <img src="./images/board_r2_c1.jpg" >
    <p>更新訪客留言資料</p>
    <form action="#" method="POST" name="formpost" onsubmit="return checkform();">
        <table>            
            <tr><td rowspan="0"><img src="./images/talk.gif"  ></td></tr>
            <?php
            while($rows=$result->fetch_assoc()){
            ?>
            <tr>
                <td>標題</td><td><input type="text" name="boardsubject" value=<?php echo $rows["boardsubject"] ?>></td>    
                <td rowspan="0"><textarea  name="boardcontent" cols="40" rows="10"><?php echo $rows["boardcontent"] ?></textarea></td>  
            </tr>
            <tr>
                <td>姓名</td><td><input type="text" name="boardname"value=<?php echo $rows["boardname"] ?> ></td>
            </tr>
            <tr>
                <td>性別</td>
                <?php
                if($rows["boardsex"]=="男"){
                ?>
                <td>男<input type="radio" name="boardsex" value="男" checked>
                    女<input type="radio" name="boardsex" value="女" ></td>
                <?php
                }else{     
                ?>
                <td>男<input type="radio" name="boardsex" value="男" >
                    女<input type="radio" name="boardsex" value="女" checked></td>
                <?php
                }     
                ?>
            </tr>
            <tr>
                <td> 郵件</td><td><input type="text" name="boardmail" value=<?php echo $rows["boardmail"] ?>></td>
            </tr>
            <tr>
                <td>網站</td><td><input type="text" name="boardweb"value=<?php echo $rows["boardweb"] ?> ></td>
            </tr>
            <?php
            }
            ?>
        </table>
        <table>
            <tr>
                <td><input type="submit"><input type="reset">
                <input type="button" value="上一頁" onClick="window.history.back();" ></td>
            </tr>
        </table>        
        </form>
</div>
</body>
</html>