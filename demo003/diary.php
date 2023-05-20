<?php
$db = mysqli_connect('localhost', '', '', 'member');
if (mysqli_connect_errno()) {
    die('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// 檢查用戶是否已登錄
session_start();
if (!isset($_SESSION['loginMember']) || ($_SESSION['loginMember'] == '')) {
    header('Location: index.php');
}

// 檢索 session 中存儲的 m_id 值
$member_id = $_SESSION['m_id'];

// 獲取表單數據
if (isset($_POST['Submit'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];

    // 插入數據
    $stmt = mysqli_prepare($db, "INSERT INTO diary (title, content, member_id) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sss", $title, $content, $member_id);
    mysqli_stmt_execute($stmt);
}

// 檢查 session 中是否存在 role 值
if (isset($_SESSION['role'])) {
    // 如果存在，則檢索 role 值
    $role = $_SESSION['role'];
} else {
    // 如果不存在，則將 role 設置為空字符串
    $role = '';
}
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>會員日記</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body class="diary-page">
    <div class="container">
        <h1>心情日記</h1>
        <div class="past-entries">
            <h2>過去的日記</h2>
            <?php
            // 查詢日記列表
            if (isset($_SESSION['m_level']) && $_SESSION['m_level'] == 'admin') {
                $sql = "SELECT id, title, content, created_at FROM diary ORDER BY created_at DESC";
            } else {
                $sql = "SELECT id, title, content, created_at FROM diary WHERE member_id = '$member_id' ORDER BY created_at DESC";
            }
            $result = mysqli_query($db, $sql);
            if (!$result) {
                die('Error: ' . mysqli_error($db));
            }

            // 顯示日記列表
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="diary-entry">';
                echo '<h3>' . htmlspecialchars($row['title']) . '</h3>';
                echo '<p>內容：' . nl2br(htmlspecialchars($row['content'])) . '</p>';
                echo '<p>發表時間：' . htmlspecialchars($row['created_at']) . '</p>';

                // 如果用戶是管理員或日記作者，則顯示修改和刪除按鈕
                $sql = 'SELECT id, title, content, created_at, member_id FROM diary ORDER BY created_at DESC'; {
                    echo '<button class="edit-btn" onclick="location.href=\'diaryedit.php?id=' . $row['id'] . '\'">Edit</button> ';
                    echo '<button class="delete-btn" onclick="location.href=\'diarydel.php?id=' . $row['id'] . '\'">Delete</button>';
                }

                echo '</div>';
            }
            ?>
        </div>

        <h1>添加新日記</h1>
        <form action="" method="post" name="formPost" id="formPost">
            <input type="text" name="title" placeholder="Title" required>
            <textarea name="content" placeholder="Content" required></textarea>
            <div class="button-cell">
                <input name="action" type="hidden" id="action" value="add">
                <input type="submit" name="Submit" value="送出">
                <input type="reset" name="Submit2" value="重設">
                <input type="button" name="Submit3" value="回上一頁" onClick=window.history.back();>
                <?php
                    echo '<div class="button-cell">';
                    if ($role == 'admin') {
                        echo '<input type="button" value="回中心" onclick="location.href=\'member_admin.php\'">';
                    } else {
                        echo '<input type="button" value="回中心" onclick="location.href=\'member_center.php\'">';
                    }
                    echo '</div>';
                ?>
            </div>
        </form>
    </div>
</body>
</html>

<?php
mysqli_close($db);
?>
