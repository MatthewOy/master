<?php
function GetSQLValueString($theValue, $theType) {
  switch ($theType) {
    case "string":
      $theValue = ($theValue != "") ? filter_var($theValue, FILTER_SANITIZE_ADD_SLASHES) : "";
      break;
    case "int":
      $theValue = ($theValue != "") ? filter_var($theValue, FILTER_SANITIZE_NUMBER_INT) : "";
      break;
    case "email":
      $theValue = ($theValue != "") ? filter_var($theValue, FILTER_VALIDATE_EMAIL) : "";
      break;
    case "url":
      $theValue = ($theValue != "") ? filter_var($theValue, FILTER_VALIDATE_URL) : "";
      break;      
  }
  return $theValue;
}

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
//執行更新動作
if(isset($_POST["action"])&&($_POST["action"]=="update")){	
	$query_update = "UPDATE board SET boardname=?, boardsex=?, boardsubject=?, boardcontent=? WHERE boardid=?";
	$stmt = $db_link->prepare($query_update);
	$stmt->bind_param("ssssi",
		GetSQLValueString($_POST["boardname"], "string"),
		GetSQLValueString($_POST["boardsex"], "string"),
		GetSQLValueString($_POST["boardsubject"], "string"),
		GetSQLValueString($_POST["boardcontent"], "string"),
		GetSQLValueString($_POST["boardid"], "int"));		
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
<table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><table align="left" border="0" cellpadding="0" cellspacing="0" width="700">
    </table></td>
  </tr>
  
  <tr>
    <td><div id="mainRegion">
        <form name="form1" method="post" action="">
          <table width="90%" border="0" align="center" cellpadding="4" cellspacing="0">
            <tr valign="top">
              <td colspan="2" class="heading">更新留言</td>
            </tr>
            <tr valign="top">
              <td>
    			<p>標題<input name="boardsubject" type="text" id="boardsubject" value="<?php echo $boardsubject;?>"></p>
                <p>姓名<input name="boardname" type="text" id="boardname" value="<?php echo $boardname;?>"></p>
                <p>性別<input name="boardsex" type="radio" id="radio" value="男" <?php if($boardsex=="男"){echo "checked";}?>>男
                  <input name="boardsex" type="radio" id="radio2" value="女" <?php if($boardsex=="女"){echo "checked";}?>>女</p>
                </td>
              <td align="right">
              	<p><textarea name="boardcontent" id="boardcontent" cols="50" rows="8"><?php echo $boardcontent;?></textarea></p>
                <p>
                  <input name="boardid" type="hidden" id="boardid" value="<?php echo $boardid;?>">
                  <input name="action" type="hidden" id="action" value="update">
                  <input type="submit" name="button" id="button" value="更新資料">
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