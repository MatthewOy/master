
<?php
//搜尋主題，用LIKE %keyword% 語法，將搜尋到的結果列表顯示
require_once("conn.php");
session_start();


  if(isset($_POST['action']) && $_POST['action'] == 'search')
  {
    proSearch();
  }
  else
  {
    displaySearch("", "");
  }
  
  function displaySearch($errorMessage="")
  {
    echo $errorMessage;
    ?>
    <form action="search.php" method="post">
      <input type="hidden" name="action" value="search" />
      <input type="text" name="keyword" size="40" value="" placeholder="搜尋主題、作者或內容" >
      <br>
      <input type="submit" class="submit" value="送出查詢" >
      <input type="button" value="返回" onclick="location.href='forum.php'" >
    </form>
    <?php
  }
    
  function proSearch()
  {
    if(isset($_POST['keyword']) && !empty($_POST['keyword'])){
        $keyword = $_POST['keyword'];
    }
    else{
        $errorMessage = "請輸入您要搜尋的關鍵字";
        displaySearch($errorMessage);
        exit;
    }
    

    $db = mysqli_connect("localhost", "root", "123456", "member");
    $stmt = $db->prepare("SELECT * FROM board WHERE boardsubject LIKE ? OR boardname LIKE ? OR boardcontent LIKE ?");
    $keyword = "%$keyword%";
    $stmt->bind_param("sss", $keyword, $keyword, $keyword);
    $stmt->execute();
    $result = $stmt->get_result();

    
    // 從结果集中獲取數據
    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
    // 在這處理每一行數據
          echo "主題: " . $row["boardsubject"] . "<br>";
          echo "作者: " . $row["boardname"] . "<br>";
          echo "內容: " . $row["boardcontent"] . "<br>";
          echo "<br>";
          echo "<hr>";
        }

        // 重新搜尋&返回留言板
        echo "<form action='search.php' method='post'>";
        echo "<input type='hidden' name='action' value='search' />";
        echo "<input type='submit' value='重新搜尋' />";
        echo "</form>";
        
        echo "<form action='forum.php' method='get'>";
        echo "<input type='submit' value='返回' />";
        echo "</form>";

    } else {
      // 顯示未找到紀錄
      echo "找不到您要的東西";
      echo "<form action='forum.php' method='get'>";
        echo "<input type='submit' value='確定' />";
        echo "</form>";
    }
  }
  
?>