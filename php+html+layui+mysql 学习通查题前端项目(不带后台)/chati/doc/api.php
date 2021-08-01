<?php


    function curl_post2($url,$data){ //发送post请求
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION,false);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        //curl_setopt($ch, CURLINFO_HEADER_OUT, TRUE);
        //curl_setopt($ch, CURLOPT_HEADER, 1);		
        //curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

        function chati1($type){
            $url = 'http://cx.icodef.com/wyn-nb?v=3';   //查题接口
            $senddata = 'question='. $type .'&type=&id=';  //提交数据
            $result =  curl_post2($url,$senddata);
            $result = json_decode($result,true);
            if($result['code'] == 1){
                return '{"answer":"'. $result['data'] .'","code":"ok","msg":"查询成功"}';
            }else{
                return '{"code":"error","msg":"'. $result['msg'] .'"}';
            }
            
        }




        $token = $_POST['token'];
        $problems = $_POST['problems'];
        $interface = $_POST['interface'];
    
        // 数据库信息
        $servername = "chati:3306"; //数据库名
        $username = "admin"; //用户名
        $password = "123456"; //密码
     
        // 创建连接
        $mysqli = mysqli_connect($servername,$username,$password,"chati");  //chati 为默认database
     
        // 检测连接
        if (!$mysqli) {
            echo '{"msg":"链接数据库失败，请重试","code":"error"}';
        }else{
            $sql = "select * from info where token = '" . $token . "'"; //查找信息  token = token
            $query = mysqli_query($mysqli,$sql);
            $row = mysqli_fetch_assoc($query);
            mysqli_close($mysqli);
            if ($row['pass']!="" and $row['user']!=""){
                if ($interface == '1'){
                    echo chati1($problems);
                }else{
                    echo '{"msg":"接口错误","code":"error"}';
                }
                
                
            }else{
                echo '{"msg":"token错误","code":"error"}';
            }





        }





?>
