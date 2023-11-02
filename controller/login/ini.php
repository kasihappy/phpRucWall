<?php
//验证是否登录，若无登陆则跳转到登陆页面
//启动session
session_start();
if (!isset($_SESSION['username'])){
    header('Location:view/login.html');
    exit;
}
