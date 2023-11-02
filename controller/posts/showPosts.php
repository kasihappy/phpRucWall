<?php
//判断登录
require './../login/ini.php';
//连接数据库
require './../db/login_db_connect.php';

if (isset($_GET['id']))
    $getId = $_GET['id'];
else
    $getId = 1;

// 定义SQL语句
$sql = "SELECT id, title, content, author FROM posts WHERE id = '$getId'";

// 执行SQL查询
$result = mysqli_query($conn, $sql);
$row = mysqli_num_rows($result);
if (!$row) {
    exit('好像没有这篇文章，查询id: '.$getId);
}

// 获取结果集中的字段数据
$post = mysqli_fetch_array($result);

// 提取字段数据
$title = $post['title'];
$content = $post['content'];
$author = $post['author'];
$post_id = $post['id'];

// 定义SQL语句
$sql = "SELECT content FROM comments where id = '$getId'";

// 执行SQL查询
$result = mysqli_query($conn, $sql);

// 获取结果集中的字段数据
$comments = mysqli_fetch_all($result);

// HTML模板
$html = <<<EOT
<!doctype html>
<!--
            ◢＼　 ☆　　 ／◣
    　  　∕　　﹨　╰╮∕　　﹨
    　  　▏　　～～′′～～ 　｜
    　　  ﹨／　　　　　　 　＼∕
    　 　 ∕ 　　●　　　 ●　＼
      ＝＝　○　∴·╰╯　∴　○　＝＝
    　    ╭──╮　　　　　╭──╮
  ╔═∪∪∪═kasihappy's=cat═∪∪∪═╗
-->
<html lang="zh-CN">

<head>
  <meta charset="utf-8">
  <title>人大校园墙</title>
  <link rel="stylesheet" href="./../../css/style.css"/>
</head>
<body>
<div class="box">
  <div class="top">
    <div class="title">人大校园墙</div>
    <div class="nav">
      <a href="./../../view/addPosts.html">我来说一说</a>
      <a href="./../../view/logout.html">退出登录</a>
    </div>
  </div>
  <div class="main">
    <div class="post">
        <h3><strong>{$title}</strong></h3>
        <p>{$content}</p>
        <h4>Author</h4>
        <p>{$author}</p>
    </div>
    
    <div class="addComment">
        <form id="addCommentForm" action="./addComment.php" method="post">
            <div class="CommentBox">
                <input type="hidden" name="post_id" value="{$post_id}">
                <input type="text" name='comment' id='comment' required="required">
                <label for="comment" >写点什么吧</label>
            </div>
            <a>
                <button type="submit">提交</button>
            </a>
        </form>
    </div>
EOT;

//输出评论
foreach ($comments as $comment)
{
    $html .= <<<EOT
    <p>
    {$comment[0]}
    </p>
EOT;

}

$html .= <<<EOT
  </div>
</div>
</body>
</html>
EOT;

// 输出HTML
echo $html;



