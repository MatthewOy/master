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

// 刪除日記
$stmt = mysqli_prepare($db, "DELETE FROM diary WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
if (mysqli_stmt_execute($stmt)) {
    echo "日記刪除成功！";
    echo '<button onclick="location.href=\'diary.php\'">確定</button>';
} else {
    echo "出錯了：" . mysqli_error($db);
}
?>