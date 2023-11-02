<?php

//验证登录
require './../login/ini.php';

if (!empty($_POST)) {
    $content = trim(htmlspecialchars($_POST['comment']));
    $id = trim(htmlspecialchars($_POST['post_id']));

    //连接数据库
    require './../db/login_db_connect.php';
    $sql = "insert into comments(id, content) values ('$id', '$content')";
    $result = mysqli_query($conn, $sql);
    header('Location:./showPosts.php?id='.$id);

}
