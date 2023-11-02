<?php

//显示posts内容

//判断登录
require './../login/ini.php';
//连接数据库
require './../db/posts_db_connect.php';

$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
$data = array('id' => $id);

$sql = 'select id, title, author, content from posts where id = :id';
$stmt = $pdo->prepare($sql);
if (!$stmt->execute($data)) {
    exit('查询失败了，是不是查询语句有问题？'.implode(' ', $stmt->errorInfo()));
}
$data = $stmt->fetch(PDO::FETCH_ASSOC);
if(empty($data)) {
    //查找的编号不存在，默认查找第一条记录
    $data = array('id' => 1);
    $sql = 'select id, title, author, content from posts where id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute($data);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
}

echo json_encode($data);