<?php
require_once("conn.php");
session_start();
//檢查是否經過登入，若有登入則重新導向
if(isset($_SESSION["loginMember"]) && ($_SESSION["loginMember"]!="")){
	//若帳號等級為 member 則導向會員中心
	if($_SESSION["memberLevel"]=="member"){
		header("Location: member_center.php");
	//否則則導向管理中心
	}else{
		header("Location: member_admin.php");	
	}
}
//執行會員登入
if(isset($_POST["username"]) && isset($_POST["passwd"])){
	//繫結登入會員資料
	$query_RecLogin = "SELECT m_username, m_passwd, m_level FROM memberdata WHERE m_username=?";
	$stmt=$db_link->prepare($query_RecLogin);
	$stmt->bind_param("s", $_POST["username"]);
	$stmt->execute();
	//取出帳號密碼的值綁定結果
	$stmt->bind_result($username, $passwd, $level);	
	$stmt->fetch();
	$stmt->close();
	//比對密碼，若登入成功則呈現登入狀態
	if(password_verify($_POST["passwd"],$passwd)){
		//計算登入次數及更新登入時間
		$query_RecLoginUpdate = "UPDATE memberdata SET m_login=m_login+1, m_logintime=NOW() WHERE m_username=?";
		$stmt=$db_link->prepare($query_RecLoginUpdate);
	    $stmt->bind_param("s", $username);
	    $stmt->execute();	
	    $stmt->close();
		//設定登入者的名稱及等級
		$_SESSION["loginMember"]=$username;
		$_SESSION["memberLevel"]=$level;
		// 查詢用戶的 m_level 值
		$sql = "SELECT m_level FROM memberdata WHERE m_username = '$username'";
		$result = mysqli_query($db_link, $sql);
		$row = mysqli_fetch_assoc($result);
		$m_level = $row['m_level'];

		// 將 m_level 值存在變數中
		$_SESSION['m_level'] = $m_level;
		//使用Cookie記錄登入資料
		if(isset($_POST["rememberme"])&&($_POST["rememberme"]=="true")){
			setcookie("remUser", $_POST["username"], time()+365*24*60);
			setcookie("remPass", $_POST["passwd"], time()+365*24*60);
		}else{
			if(isset($_COOKIE["remUser"])){
				setcookie("remUser", $_POST["username"], time()-100);
				setcookie("remPass", $_POST["passwd"], time()-100);
			}
		}
		//若帳號等級為 member 則導向會員中心
		if($_SESSION["memberLevel"]=="member"){
			header("Location: member_center.php");
		//否則則導向管理中心
		}else{
			header("Location: member_admin.php");	
		}
	}else{
		header("Location: index.php?errMsg=1");
	}
}
?>
<html>
<head>
<?php include 'headjq.php';?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>會員系統</title>
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
          <p class="heading"> 本會員系統具有以下功能：</p>
          <ol>
            <li>可加入會員，成為會員後可修改自己的資料。</li>
            <li>若遺忘密碼，可由系統發出email通知。</li>
            <li>管理者可以修改、刪除會員的資料。</li>
			<li>登入後才能在留言板自由留言。</li>
			<li>會員可於留言板使用搜尋功能。</li>
			<li>僅管理員可對留言板進行管理。</li>
			<li>新增心情筆記，作者及管理員可修改、刪除。</li>
          </ol>
		</td>
			<td class="image-cell"> 
				<img src="images/007.jpg" alt="貓貓吐舌頭" width="500" height="600">
    		</td>
        <td width="200">
        	<div class="regbox">
				<?php if(isset($_GET["errMsg"]) && ($_GET["errMsg"]=="1")){?>
          		<div class="errDiv"> 帳號或密碼錯誤！</div>
          		<?php }?>
          		<p class="heading">登入系統</p>
          		<form name="form1" method="post" action="">
            		<p>帳號：
              			<br>
              		<input name="username" type="text" class="logintextbox" id="username" value="<?php if(isset($_COOKIE["remUser"]) && ($_COOKIE["remUser"]!="")) echo $_COOKIE["remUser"];?>">
            			</p>
            		<p>密碼：<br>
              		<input name="passwd" type="password" class="logintextbox" id="passwd" value="<?php if(isset($_COOKIE["remPass"]) && ($_COOKIE["remPass"]!="")) echo $_COOKIE["remPass"];?>">
            			</p>
					<p>
    				<input name="rememberme" type="checkbox" id="rememberme" value="true" checked> 記住我
						</p>
					<p class="button-cell">
    				<input type="submit" name="button" id="button" value="登入">
						</p>
            	</form>
          		<p align="left"><a href="admin_passmail.php">忘記密碼?</a></p>
          		<p align="left"><a href="member_join.php">註冊新帳號</a></p>
			</div>
		</td>
      </tr>
    </table></td>
  </tr>
</table>
<?php include 'footjq.php';?>
</body>
</html>
<?php
	$db_link->close();
?>