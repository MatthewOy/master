<?php
require_once("conn.php");
session_start();


if (!isset($_SESSION["loginMember"]) || ($_SESSION["loginMember"] == "")) {
    echo "<script>alert('您還沒登入，無法進入留言板。'); location.href='index.php';</script>";
    exit;
}

$pageRow_records = 5;
//預設頁數
$num_pages = 1;
//若已經有翻頁，將頁數更新
if (isset($_GET['page'])) {
  $num_pages = $_GET['page'];
}
//本頁開始記錄筆數 = (頁數-1)*每頁記錄筆數
$startRow_records = ($num_pages -1) * $pageRow_records;
//未加限制顯示筆數的SQL敘述句
$query_RecBoard = "SELECT * FROM board ORDER BY boardtime DESC";
//加上限制顯示筆數的SQL敘述句，由本頁開始記錄筆數開始，每頁顯示預設筆數
$query_limit_RecBoard = $query_RecBoard." LIMIT {$startRow_records}, {$pageRow_records}";
//以加上限制顯示筆數的SQL敘述句查詢資料到 $RecBoard 中
$RecBoard = $db_link->query($query_limit_RecBoard);
//以未加上限制顯示筆數的SQL敘述句查詢資料到 $all_RecBoard 中
$all_RecBoard = $db_link->query($query_RecBoard);
//計算總筆數
$total_records = $all_RecBoard->num_rows;
//計算總頁數=(總筆數/每頁筆數)後無條件進位。
$total_pages = ceil($total_records/$pageRow_records);
?>

<html>
<head>
<title>留言版</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body bgcolor="#ffffff">
<table width="800" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><table align="center" border="0" cellpadding="0" cellspacing="0" width="700">
      <td id="links" align="center"><a href="post.php">加入留言</a> | <a href="member_center.php">回會員中心</a></td>
      </table>
    </td>
  </tr>
  <tr>
    <td><div id="mainRegion">
        <?php	while($row_RecBoard=$RecBoard->fetch_assoc()){ ?>
        <table width="90%" border="0" align="center" cellpadding="4" cellspacing="0">
          <tr valign="top">
            <td width="60" align="center" class="underline">
              <?php if($row_RecBoard["boardsex"]=="男"){;?>
              <img src="images/men.jpg" alt="男" width="50" height="50">
              <?php }else{?>
              <img src="images/women.jpg" alt="女" width="50" height="50">
              <?php }?>
              <br>
              <span class="postname"><?php echo $row_RecBoard["boardname"];?></span>
            </td>
            <td class="underline">
            	  <span class="smalltext">[<?php echo $row_RecBoard["boardid"];?>]</span>
            	  <span class="heading"> <?php echo $row_RecBoard["boardsubject"];?></span>
            	  <p><?php echo nl2br($row_RecBoard["boardcontent"]);?></p>
            	  <p align="right" class="smalltext">
            	  <?php echo $row_RecBoard["boardtime"];?>
            	  </p>
            </td>
          </tr>          
        </table>
        <?php }?>
        <table width="90%" border="0" align="center" cellpadding="4" cellspacing="0">
          <tr>
            <td valign="middle"><p>資料筆數：<?php echo $total_records;?></p></td>
            <td align="right"><p>
                <?php if ($num_pages > 1) { // 若不是第一頁則顯示 ?>
                <a href="?page=1">第一頁</a> | <a href="?page=<?php echo $num_pages-1;?>">上一頁</a> |
                <?php }?>
                <?php if ($num_pages < $total_pages) { // 若不是最後一頁則顯示 ?>
                <a href="?page=<?php echo $num_pages+1;?>">下一頁</a> | <a href="?page=<?php echo $total_pages;?>">最末頁</a>
                <?php }?>
              </p></td>
          </tr>
        </table>
      </div></td>
  </tr>
  <tr>
    <td><table align="center" border="0" cellpadding="0" cellspacing="0" width="700">
        <td><a href="search.php">[搜尋]</a></td>        
      </table>
    </td>
  </tr>
</table>
</body>
</html>
<?php
$db_link->close();
?>