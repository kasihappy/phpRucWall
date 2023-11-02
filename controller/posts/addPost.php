<?php

//验证登录
require './../login/ini.php';

if (!empty($_POST)) {
    $title = trim(htmlspecialchars($_POST['title']));
    $author = trim(htmlspecialchars($_POST['author']));
    $content = trim(htmlspecialchars($_POST['content']));

    //连接数据库
    require './../db/login_db_connect.php';
    $sql = "insert into posts(title, author, content) values ('$title', '$author', '$content')";
    $result = mysqli_query($conn, $sql);
    header('Location:./../../index.php');

}
