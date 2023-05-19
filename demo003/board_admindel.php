<?php
require_once("conn.php");
session_start();
//檢查是否經過登入
if(!isset($_SESSION["loginMember"]) || ($_SESSION["loginMember"]=="")){
	header("Location: index.php");
}
//執行登出動作
if(isset($_GET["logout"]) && ($_GET["logout"]=="true")){
	unset($_SESSION["loginMember"]);
	header("Location: index.php");
}
//執行刪除動作
if(isset($_POST["action"])&&($_POST["action"]=="delete")){	
	$sql_query = "DELETE FROM board WHERE boardid=?";
	$stmt=$db_link->prepare($sql_query);
	$stmt->bind_param("i",$_POST["boardid"]);
	$stmt->execute();
	$stmt->close();
	//重新導向回到主畫面
	header("Location: board_admin.php");
}
$query_RecBoard = "SELECT boardid, boardname, boardsex, boardsubject, boardcontent FROM board WHERE boardid=?";
$stmt=$db_link->prepare($query_RecBoard);
$stmt->bind_param("i", $_GET["id"]);
$stmt->execute();
$stmt->bind_result($boardid, $boardname, $boardsex, $boardsubject, $boardcontent);
$stmt->fetch();
?>
<html>
<head>
<title>留言板管理系統</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body bgcolor="#ffffff">
<table width="900" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><table align="left" border="0" cellpadding="0" cellspacing="0" width="700">
    </table></td>
  </tr>
  
  <tr>
    <td><div id="mainRegion">
        <form name="form1" method="post" action="">
          <table width="90%" border="0" align="center" cellpadding="4" cellspacing="0">
            <tr valign="top">
              <td class="heading">刪除留言資料</td>
            </tr>
            <tr valign="top">
              <td>
                <p><strong>標題</strong>：<?php echo $boardsubject;?> <strong>姓名</strong>：<?php echo $boardname;?> <strong>性別</strong>：<?php echo $boardsex;?></p><br>
                <p><strong>留言內容</strong>：<?php echo nl2br($boardcontent);?></p>
              </td>
            </tr>
            <tr valign="top">
              <td align="center"><p>
                  <input name="boardid" type="hidden" id="boardid" value="<?php echo $boardid;?>">
                  <input name="action" type="hidden" id="action" value="delete">
                  <input type="submit" name="button" id="button" value="確定刪除?">
                  <input type="button" name="button3" id="button3" value="回上一頁" onClick="window.history.back();">
                </p></td>
            </tr>
          </table>
        </form>
      </div></td>
  </tr>
  <tr>
    <td><table align="left" border="0" cellpadding="0" cellspacing="0" width="700">
      <tr>
        <td><a href="?logout=true">登出管理</a></td>
        <td align="right" valign="top" class="trademark">測試用管理系統 </td>
      </tr>
    </table></td>
  </tr>
</table>

</body>
</html>
<?php
	$stmt->close();
	$db_link->close();
?>