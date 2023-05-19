<?php
$db = mysqli_connect('localhost', 'root', '123456', 'member');
if (mysqli_connect_errno()) {
    die('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// 檢查用戶是否已登錄
session_start();
if (!isset($_SESSION['loginMember']) || ($_SESSION['loginMember'] == '')) {
    header('Location: index.php');
}

// 獲取日記ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header('Location: diary.php');
    exit;
}

// 檢查表單是否已提交
if (isset($_POST['title']) && isset($_POST['content'])) {
    // 獲取新的日記標題和內容
    $title = $_POST['title'];
    $content = $_POST['content'];

    // 更新數據庫中的數據
    $stmt = mysqli_prepare($db, "UPDATE diary SET title = ?, content = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "ssi", $title, $content, $id);
    if (mysqli_stmt_execute($stmt)) {
        echo "日記更新成功！";
    } else {
        echo "出錯了：" . mysqli_error($db);
    }
}

// 查詢日記標題和內容
$stmt = mysqli_prepare($db, "SELECT title, content FROM diary WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $title, $content);
mysqli_stmt_fetch($stmt);
?>

<!-- 顯示表單 -->
<form action="diaryedit.php?id=<?php echo $id; ?>" method="post">
    <label for="title">標題：</label>
    <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($title); ?>">
    <br>
    <label for="content">內容：</label>
    <textarea name="content" id="content" class="content-textarea"><?php echo htmlspecialchars($content); ?></textarea>
    <br>
    <input type="submit" value="更新">
    <button type="button" onclick="location.href='diary.php'">返回</button>
</form>
