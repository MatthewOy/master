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
	unset($_SESSION["memberLevel"]);
	header("Location: index.php");
}
//繫結登入會員資料
$query_RecMember = "SELECT * FROM memberdata WHERE m_username = '{$_SESSION["loginMember"]}'";
$RecMember = $db_link->query($query_RecMember);	
$row_RecMember=$RecMember->fetch_assoc();
// 從查詢結果中檢索 m_id 的值
$m_id = $row_RecMember['m_id'];

// 將 m_id m_username 的值存儲在 session 中
$_SESSION['m_id'] = $m_id;
$_SESSION['m_username'] = $row_RecMember['m_username'];
?>
<html>
<head>
<?php include 'headjq.php';?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>會員中心</title>
<link href="style.css" rel="stylesheet" type="text/css">
  <script>
    $(document).ready(function(){
      function fade() {
      $("img[src='images/welcome.jpg']").fadeIn(1000).fadeOut(1000, fade);
      }
      fade();
    });
  </script>
</head>

<body>
<table width="800" border="0" align="center" cellpadding="4" cellspacing="0">
  <tr>
    <td class="tdbline"><img src="images/welcome.jpg" alt="會員系統" width="800" height="300"></td>
  </tr>
  <tr>
    <table width="100%" border="1" cellspacing="2" cellpadding="0">
      <tr valign="top">
        <td class="text-cell"><p class="title">歡迎光臨否放論壇</p>
          <ol>
            <li>請遵守社群規範</li>
            <li>請勿作出違反法律規定之行為</li>
            <li><a href="psytest.php">點此進入心理測驗</li>
            <li><a href="forum.php">點此進入留言板</li>
            <li><a href="diary.php">點此進入日記本</li>
          </ol>
        </td>
        <td class="image-cell">
          <img src="images/大谷V.gif" alt="大谷V" width="400" height="400">
    		</td>
        <td width="200">
        <div class="regbox">
          <p class="heading"><strong>會員系統</strong></p>
            <p><strong><?php echo $row_RecMember["m_name"];?></strong> 您好。</p>
            <p>您總共登入了 <?php echo $row_RecMember["m_login"];?> 次。<br>
            本次登入的時間為：<br>
            <?php echo $row_RecMember["m_logintime"];?></p>
            <p align="center"><a href="member_update.php">修改資料</a> | <a href="?logout=true">登出系統</a></p>
        </div>
        </td>
      </tr>
      </table>
    </td>
  </tr>
</table>

</body>
</html>
<?php
	$db_link->close();
?>