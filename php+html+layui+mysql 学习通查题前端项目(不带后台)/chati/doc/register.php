<?php

    $user = $_POST['user'];
    $pass = $_POST['pass'];


    if($user == "" or $pass == ""){
        echo '{"msg":"账号或密码不能为空","code":"error"}';
    }

    if(strlen($user) < 6 or strlen($user) > 16 ){
        echo '{"msg":"账号长度错误，请填写6-16位长度","code":"error"}';
    }

    if(strlen($pass) < 6 or strlen($user) > 18 ){
        echo '{"msg":"账号长度错误，请填写6-18位长度","code":"error"}';
    }


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
        
        //$sql = "create table info(user varchar(16) not null,pass varchar(18) not null,token varchar(32) not null)"; //添加表

        $sql = "select * from info where user = '" . $user . "'"; //查找信息  user = 注册用户名



        $query = mysqli_query($mysqli,$sql);
        $row = mysqli_fetch_assoc($query);

        mysqli_close($mysqli);

        if ($row['user'] == ""){
            $sql = "insert into info(user,pass,token) values('". $user ."','". $pass ."','". md5($user.$pass.'emisun.cn') ."')"; //注册
            $query = mysqli_query($mysqli,$sql);
            if(!$query){
                echo '{"msg":"注册成功","code":"ok"}';
            }else{
                echo '{"msg":"注册失败，添加语句出错","code":"error"}';
            }

        }else{
            echo '{"msg":"注册失败，账号已存在","code":"error"}';
        }
    }







    //echo '{"msg":"登录成功","code":"ok","token":"123313123"}';
?>