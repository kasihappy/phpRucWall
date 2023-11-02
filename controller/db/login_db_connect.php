<?php
//设置字符集
header('Content-Type:text/html;charset=utf8');

//连接数据库
$servername = "localhost";
$username = "hacker";
$password = "123456";
$database = "rucwall";
$conn = new mysqli('localhost', 'hacker', '123456', 'rucwall');
if ($conn->connect_error){
	die('connection error:'.$conn->connect_error);
}
