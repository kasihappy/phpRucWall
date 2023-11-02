<?php
header('Content-Type:text/html;charset=utf-8');

//注册页面
//连接数据库
require './../db/login_db_connect.php';


//判断表单是否提交
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $pwd = $_POST['password'];

    //简单的过滤
    if ($username == '' || $pwd == '') {
        exit('账号或密码不能为空');
    } else {
        $sql = "insert into users(username, password) values ('$username', '$pwd');";
        $select = "select username from users where username = '$username'";

        //查看是否已存在该用户名
        $result = mysqli_query($conn, $select);
        $row = mysqli_num_rows($result);
        if (!$row) {
            if (mysqli_query($conn, $sql)) {
                //成功注册，跳转登陆页面
                echo "<script>alert('注册成功，去登陆');location='./../../view/login.html'</script>";
            } else {
                //失败，重新注册
                echo "<script>alert('不知道为什么失败了呢，试试重新注册吧~');location='./../../view/register.html'</script>";
            }
        } else {
            //用户已存在
            echo "<script>alert('这个用户已经存在啦，换一个吧~');location='./../../view/register.html'</script>";
        }
    }
} else {
    echo "<script>alert('好像发生了一些错误，你的表单没有提交成功，再试试吧~');location='./../../view/register.html'</script>";
}
