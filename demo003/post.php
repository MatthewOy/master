<?php 
function GetSQLValueString($theValue, $theType){
  switch ($theType) {
    case "string":
      $theValue = ($theValue != "") ? filter_var($theValue, FILTER_SANITIZE_ADD_SLASHES) : "";
      break;
    case "int":
      $theValue = ($theValue != "") ? filter_var($theValue, FILTER_SANITIZE_NUMBER_INT) : "";
      break;
        
  }
  return $theValue;
}

if(isset($_POST["action"])&&($_POST["action"]=="add")){
	require_once("conn.php");	
	$query_insert = "INSERT INTO board (boardname ,boardsex ,boardsubject ,boardtime ,boardcontent) VALUES (?, ?, ?, NOW(), ?)";
	$stmt = $db_link->prepare($query_insert);
	$stmt->bind_param("ssss",
		GetSQLValueString($_POST["boardname"], "string"),
		GetSQLValueString($_POST["boardsex"], "string"),
		GetSQLValueString($_POST["boardsubject"], "string"),
		GetSQLValueString($_POST["boardcontent"], "string"));
	$stmt->execute();
	$stmt->close();
	$db_link->close();
	//重新導向回到主畫面
	header("Location: forum.php");
}	
?>
<html>
<head>
<title>留言版</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="style.css" rel="stylesheet" type="text/css">
<script language="javascript">
function checkForm(){
	if(document.formPost.boardsubject.value==""){
		alert("請填寫標題!");
		document.formPost.boardsubject.focus();
		return false;
	}
	if(document.formPost.boardname.value==""){
		alert("請填寫姓名!");
		document.formPost.boardname.focus();
		return false;
	}	
	
	 
	if(document.formPost.boardcontent.value==""){
		alert("請填寫內容!");
		document.formPost.boardcontent.focus();
		return false;
	}
		return confirm('確定送出嗎？');
}


</script>
</head>
<body bgcolor="#ffffff">
<table width="800" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><table align="right" border="0" cellpadding="0" cellspacing="0" width="700">
        <tr>
          <td><a href="forum.php">回留言板</a></td>
          <td><a href="index.php">回會員中心</a></td>
        </tr>
      </table></td>
  </tr>
  
  <tr>
    <td background="images/board_r3_c1.jpg"><div id="mainRegion">
        <form action="" method="post" name="formPost" id="formPost" onSubmit="return checkForm();">
          <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0">
            <tr valign="top">
              <span class="heading">留言</span>
              <td>
    			<p>標題<input type="text" name="boardsubject" id="boardsubject"></p>
                <p>姓名<input type="text" name="boardname" id="boardname"></p>
                <p>性別
                  <input name="boardsex" type="radio" id="radio" value="男" checked>男
                  <input type="radio" name="boardsex" id="radio2" value="女">女
                </p>
              </td>
              <td align="right">
                <p><textarea name="boardcontent" id="boardcontent" cols="40" rows="10"></textarea></p>
              </td>
            </tr>
            <tr valign="top">
              <td colspan="3" align="center" valign="middle">
    			<input name="action" type="hidden" id="action" value="add">
                <input type="submit" name="button" id="button" value="送出留言">
                <input type="reset" name="button2" id="button2" value="重設資料">
                <input type="button" name="button3" id="button3" value="回上一頁" onClick="window.history.back();"></td>
            </tr>
          </table>
        </form>
      </div></td>
  </tr>
  
</table>
</body>
</html>