<?php
//主页
//验证是否登录
require 'controller/login/ini.php';

//连接数据库
require './controller/db/login_db_connect.php';

// 定义SQL语句
$sql = "SELECT id, title, content, author FROM posts WHERE id = 1";

// 执行SQL查询
$result = $conn->query($sql);

// 获取结果集中的字段数据
$post = $result->fetch_array();
echo 1;
// 提取字段数据
$title = $post['title'];
$content = $post['content'];
$author = $post['author'];
$post_id = $post['id'];
var_dump($post);
// 定义SQL语句
$sql = "SELECT content FROM comments where id = 1";

// 执行SQL查询
$result = $conn->query($sql);
echo 3;
// 获取结果集中的字段数据
$comments = mysqli_fetch_all($result);
$numberOfComments = sizeof($comments);

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
  <link rel="stylesheet" href="./css/style.css"/>
</head>
<body>
<div class="box">
  <div class="top">
    <div class="title">人大校园墙</div>
    <div class="nav">
      <a href="./view/addPosts.html">我来说一说</a>
      <a href="./view/logout.html">退出登录</a>
    </div>
  </div>
  <div class="main">
    <div>今天的新鲜事</div>
    <div class="post">
      <a href="./controller/posts/showPosts.php?id=1" class="post-title">
        <h3><strong>{$title}</strong></h3>
      </a>
      <div class="post-meta">
        <span><i class="author"></i>{$author}</span>
        <span><i class="comments-number"></i>{$numberOfComments}</span>
      </div>
      <div class="post-content">
        <p>{$content}</p>
      </div>
      <div class="post-comments">
    <p>
EOT;

foreach ($comments as $comment)
{
    $html .= <<<EOT
    {$comment[0]}<br>
EOT;
}

$html .= <<<EOT
        </p>
      </div>
    </div>
EOT;

$id = 2;


while (true)
{
    // 定义SQL语句
    $sql = "SELECT id, title, content, author FROM posts WHERE id = '$id'";
    // 定义SQL语句
    $sqlC = "SELECT content FROM comments where id = '$id'";
    // 执行SQL查询
    $result = mysqli_query($conn, $sql);

    // 获取结果集中的字段数据
    $row = mysqli_num_rows($result);
    if (!$row)
        break;
    $post = mysqli_fetch_array($result);

    // 提取字段数据
    $title = $post['title'];
    $content = $post['content'];
    $author = $post['author'];
    $post_id = $post['id'];

    // 执行SQL查询
    $result = mysqli_query($conn, $sqlC);

    // 获取结果集中的字段数据
    $comments = mysqli_fetch_all($result);
    $numberOfComments = sizeof($comments);

    $html .= <<<EOT
    <div id="{$id}" class="post" style="display: none">
      <a href="./controller/posts/showPosts.php?id={$id}" class="post-title">
        <h3><strong>{$title}</strong></h3>
      </a>
      <div class="post-meta">
        <span><i class="author"></i>{$author}</span>
        <span><i class="comments-number"></i>{$numberOfComments}</span>
      </div>
      <div class="post-content">
        <p>{$content}</p>
      </div>
      <div class="post-comments">
    <p>
EOT;
    foreach ($comments as $comment)
    {
            $html .= <<<EOT
            {$comment[0]}<br>
        EOT;
    }

    $html .= <<<EOT
            </p>
          </div>
        </div>
    EOT;
    $id++;
}
$html .= <<< EOT
    <span id="now" style="display: none">2</span>
    <button id="showMore">显示更多</button>
    <script type="text/javascript">
    const numE1 = document.getElementById('now');
    const btn = document.getElementById('showMore');
    
    btn.addEventListener('click', increase);
    
    function increase() {
        let num = parseInt(numE1.innerText);
        if (num >= {$id})
            return
        num++;
        numE1.innerText = num;
        document.getElementById(''+(num-1)).style.display = 'block';
    }
    </script>
  </div>
</div>
</body>
</html>
EOT;




echo $html;

