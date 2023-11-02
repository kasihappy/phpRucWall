<?php
//退出登录
session_start();

//因为检查时只检查这个
unset($_SESSION['username']);

//跳转到登录页面
header('Location:./../../view/login.html');
