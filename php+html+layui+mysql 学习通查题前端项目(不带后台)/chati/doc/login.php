<?php

    $user = $_POST['user'];
    $pass = $_POST['pass'];


    // 数据库信息
    $servername = "chati:3306"; //服务器地址
    $username = "admin"; //用户名
    $password = "123456"; //密码
 
    // 创建连接
    $mysqli = mysqli_connect($servername,$username,$password,"chati");
 
    // 检测连接
    if (!$mysqli) {
        echo '{"msg":"链接数据库失败，请重试","code":"error"}';
    }else{
        //mysqli_query($mysqli,'use chati');
        //$sql = "insert into info(user,pass,token) values('admin','2044186427','41f29bf0468c930f1b5f4d9733076403')"; //注册
        //$sql = "create table info(user varchar(16) not null,pass varchar(18) not null,token varchar(32) not null)"; //添加表

        $sql = "select * from info where user = '" . $user . "'"; //查找信息  user = 登录用户名



        $query = mysqli_query($mysqli,$sql);
        $row = mysqli_fetch_assoc($query);

        mysqli_close($mysqli);

        if ($pass == $row['pass']){
            echo '{"msg":"登录成功","code":"ok","token":"'. $row['token'] .'"}';
        }else{
            echo '{"msg":"登录失败","code":"error"}';
        }
    }







    //echo '{"msg":"登录成功","code":"ok","token":"123313123"}';
?>