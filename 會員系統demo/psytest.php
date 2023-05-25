<?php 
if(isset($_GET["question"])&&($_GET["question"]!="")){
	if(isset($_GET["answer1"])&&($_GET["answer1"]!="")){
		setcookie("answer1",$_GET["answer1"],time()+3600);
		header("Location: psytest.php?step=2");
	}
	if(isset($_GET["answer2"])&&($_GET["answer2"]!="")){
		setcookie("answer2",$_GET["answer2"],time()+3600);
		header("Location: psytest.php?step=3");
	}
	if(isset($_GET["answer3"])&&($_GET["answer3"]!="")){
		setcookie("answer3",$_GET["answer3"],time()+3600);
		header("Location: psytest.php?step=4");
	}
	if(isset($_GET["answer4"])&&($_GET["answer4"]!="")){
		setcookie("answer4",$_GET["answer4"],time()+3600);
		header("Location: psytest.php?result=true");
	}			
}
if(isset($_GET["restart"])&&($_GET["restart"]!="")){
	setcookie("answer1","",time()-3600);
	setcookie("answer2","",time()-3600);
	setcookie("answer3","",time()-3600);
	setcookie("answer4","",time()-3600);
}
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>心理測驗</title>
</head>
<body>
<body background="images/temp.jpg">
<p>心理測驗：</p>
<?php if(($_SERVER['QUERY_STRING']=="")|| isset($_GET["restart"])){?>
<p><a href="psytest.php?step=1">準備好了嗎？請按此開始測驗！</a></p>
<p><a href="member_center.php">回會員中心</a></p>
<?php }?>
<?php if(isset($_GET["step"])&&($_GET["step"]==1)){?>
<p>假如你是一隻兔子：</p>
<form id="form1" name="form1" method="get" action="">
  <p>1.你經過一座橋，橋邊風景很漂亮，你會：</p>
  <p><input name="answer1" type="radio" id="radio" value="1" checked="checked" />
    慢慢走欣賞風景<br />
    <input type="radio" name="answer1" id="radio2" value="2" />
    開心蹦蹦跳<br />
    <input type="radio" name="answer1" id="radio3" value="3" />
    不理會直接跑走</p>
  <p>
    <input type="submit" id="button" value="下一步" />
    <input name="question" type="hidden" id="question" value="true">
  </p>
</form>
<?php }else if(isset($_GET["step"])&&($_GET["step"]=="2")){?>
<form id="form2" name="form2" method="get" action="">
  <p>2.中途遇見一隻小貓，躺在路旁一動也不動，你認為是：</p>
  <p><input name="answer2" type="radio" id="radio4" value="1" checked="checked" />
    它暈倒了<br />
    <input type="radio" name="answer2" id="radio5" value="2" />
    它在睡覺<br />
    <input type="radio" name="answer2" id="radio6" value="3" />
    它掛了</p>
  <p>
    <input type="submit" id="button2" value="下一步" />
    <input name="question" type="hidden" id="question" value="true">
  </p>
</form>
<?php }else if(isset($_GET["step"])&&($_GET["step"]=="3")){?>
<form id="form3" name="form3" method="get" action="">
  <p>3.走到一半的時候，你家的鑰匙突然掉進水溝，你會：  </p>
  <p>
    <input name="answer3" type="radio" id="radio7" value="1" checked="checked" />
    翻下去撿<br />
    <input type="radio" name="answer3" id="radio8" value="2" />
    看看有沒有路過的好心人幫忙找<br />
    <input type="radio" name="answer3" id="radio9" value="3" />
    當沒事，直接回家</p>
  <p>
    <input type="submit" id="button3" value="下一步" />
    <input name="question" type="hidden" id="question" value="true">
  </p>
</form>
<?php }else if(isset($_GET["step"])&&($_GET["step"]=="4")){?>
<form id="form4" name="form4" method="get" action="">
  <p>4.回到家門口後，你會： </p>
  <p>
    <input name="answer4" type="radio" id="radio10" value="1" checked="checked" />
    打電話給朋友聊天<br />
    <input type="radio" name="answer4" id="radio11" value="2" />
    翻牆進去<br />
    <input type="radio" name="answer4" id="radio12" value="3" />
    靜靜坐著等家人回來開門</p>
  <p>
    <input type="submit" id="button4" value="看測驗結果" />
    <input name="question" type="hidden" id="question" value="true">
  </p>
</form>
<?php }?>
<p>
  <?php if(isset($_GET["result"])&&($_GET["result"]=="true")){?>
</p>
<p>分析結果：</p>
<p>【人生觀態度】</p>
<?php 
if(isset($_COOKIE["answer1"])&&($_COOKIE["answer1"]!="")){
	switch ($_COOKIE["answer1"]){
	case "1":
		echo "<p>你對自己未來沒有太多規劃，走一步算一步！</p>";
		break;
	case "2":	
		echo "<p>你對自己的未來充滿自信！</p>";
		break;
	case "3":		
		echo "<p>你是為了別人而活，庸庸碌碌過一生！</p>";
		break;
	}	
}
?>
<p>【愛情觀】</p>
<?php 
if(isset($_COOKIE["answer2"])&&($_COOKIE["answer2"]!="")){
	switch ($_COOKIE["answer2"]){
	case "1":
		echo "<p>你對愛情不夠專心。</p>";
		break;
	case "2":	
		echo "<p>你是很容易暈船的那種人。</p>";
		break;
	case "3":		
		echo "<p>你對愛缺乏渴望。</p>";
		break;
	}	
}
?>
<p>【對金錢的看法】</p>
<?php 
if(isset($_COOKIE["answer3"])&&($_COOKIE["answer3"]!="")){
	switch ($_COOKIE["answer3"]){
	case "1":
		echo "<p>你貪財如命。</p>";
		break;
	case "2":	
		echo "<p>你對金錢管理比較謹慎。</p>";
		break;
	case "3":		
		echo "<p>你對金錢比較不在乎。</p>";
		break;
	}	
}
?>
<p>【對家的感覺！包括對家人的態度】</p>
<?php 
if(isset($_COOKIE["answer4"])&&($_COOKIE["answer4"]!="")){
	switch ($_COOKIE["answer4"]){
	case "1":
		echo "<p>你對家沒什麼依賴感，如果發生事情你會優先找朋友。</p>";
		break;
	case "2":	
		echo "<p>你對家人的態度時常在不耐煩與後悔中反覆度過。</p>";
		break;
	case "3":		
		echo "<p>你跟家人處的很好，彼此會互相照顧。</p>";
		break;
	}	
}
?>
<p><a href="psytest.php?restart=true">重來一次</a></p>
<p><a href="member_center.php">回會員中心</a></p>
<?php }?>
</body>
</html>