<?php
/**
 *
 * User: suyin
 * Date: 2017/8/19 17:09
 *
 */
require '../lib/PHPMailer.class.php';
require '../lib/SMTP.class.php';
require '../lib/pop3.class.php';
require '../lib/PHPMailerAutoload.class.php';


$function = $_GET['action'];
call_user_func($function);

function sendMail($title='黄色网站找回密码邮件',$from='suyin@ssunse.com',$to='452292741@qq.com',$userName='su_yin12@qq.com',$password='sdvhpgakahujbjdj',$body='呵呵')
{
    $body = "<h3>亲爱的" . $to . "：</h3><br/>您在" . time() . "提交了找回密码请求。请点击下面的链接重置密码（按钮24小时内有效）。<br/>
            <br/>如果以上链接无法点击，请将它复制到你的浏览器地址栏中进入访问。<br/>如果您没有提交找回密码请求，请忽略此邮件。
            这是爸爸的测试邮件发送,请忽略";
    $mail = new PHPMailer();
    //是否启用smtp的debug进行调试 开发环境建议开启 生产环境注释掉即可 默认关闭debug调试模式
    //    $mail->SMTPDebug = 1;
    //使用smtp鉴权方式发送邮件，当然你可以选择pop方式 sendmail方式等 本文不做详解
    //可以参考http://phpmailer.github.io/PHPMailer/当中的详细介绍
    $mail->isSMTP();
    //smtp需要鉴权 这个必须是true
    $mail->SMTPAuth = true;
    //链接qq域名邮箱的服务器地址
    $mail->Host = 'smtp.qq.com';
    //设置使用ssl加密方式登录鉴权
    $mail->SMTPSecure = 'ssl';
    //设置ssl连接smtp服务器的远程服务器端口号 可选465或587
    $mail->Port = 465;
    //设置smtp的helo消息头 这个可有可无 内容任意
    //    $mail->Helo = 'Hello smtp.qq.com Server';
    //设置发件人的主机域 可有可无 默认为localhost 内容任意，建议使用你的域名
    $mail->Hostname = 'ssunse.com';
    //设置发送的邮件的编码 可选GB2312 我喜欢utf-8 据说utf8在某些客户端收信下会乱码
    $mail->CharSet = 'UTF-8';
    //设置发件人姓名（昵称） 任意内容，显示在收件人邮件的发件人邮箱地址前的发件人姓名
    $mail->FromName = 'suyin';
    //smtp登录的账号 这里填入字符串格式的qq号即可
    $mail->Username = $userName;//su_yin12@qq.com
    //smtp登录的密码 这里填入“独立密码” 若为设置“独立密码”则填入登录qq的密码 建议设置“独立密码”
    $mail->Password = $password;//sdvhpgakahujbjdj
    //设置发件人邮箱地址 这里填入上述提到的“发件人邮箱”
    $mail->From = $from;
    //邮件正文是否为html编码 注意此处是一个方法 不再是属性 true或false
    $mail->isHTML(true);
    //设置收件人邮箱地址 该方法有两个参数 第一个参数为收件人邮箱地址 第二参数为给该地址设置的昵称 不同的邮箱系统会自动进行处理变动 这里第二个参数的意义不大
    $mail->addAddress($to, '');
    //添加多个收件人 则多次调用方法即可
    //    $mail->addAddress('644186268@qq.com');
    //添加该邮件的主题
    $mail->Subject = $title;
    //添加邮件正文 上方将isHTML设置成了true，则可以是完整的html字符串 如：使用file_get_contents函数读取本地的html文件
    $mail->Body = $body;
    //为该邮件添加附件 该方法也有两个参数 第一个参数为附件存放的目录（相对目录、或绝对目录均可） 第二参数为在邮件附件中该附件的名称
    //    $mail->addAttachment('', '');
    //同样该方法可以多次调用 上传多个附件
    //    $mail->addAttachment('', '');
    //发送命令 返回布尔值
    //PS：经过测试，要是收件人不存在，若不出现错误依然返回true 也就是说在发送之前 自己需要些方法实现检测该邮箱是否真实有效
    $status = $mail->send();
    $msg = '';//返回信息
    //简单的判断与提示信息
    if ($status) {
        $msg = '发送邮件成功';
    } else {
        $msg = '发送邮件失败，错误信息为<pre>：' . $mail->ErrorInfo;
    }
    $ret = array('status' => $status, 'msg' => $msg);

    return $ret;
}

    //生成验证码
    function verificationCode(){
        //10>设置session,必须处于脚本最顶部
        session_start();

        $image = imagecreatetruecolor(100, 30);    //1>设置验证码图片大小的函数
        //5>设置验证码颜色 imagecolorallocate(int im, int red, int green, int blue);
        $bgcolor = imagecolorallocate($image,255,255,255); //#ffffff
        //6>区域填充 int imagefill(int im, int x, int y, int col) (x,y) 所在的区域着色,col 表示欲涂上的颜色
        imagefill($image, 0, 0, $bgcolor);
        //10>设置变量
        $captcha_code = "";
        //7>生成随机数字
        for($i=0;$i<4;$i++){
            //设置字体大小
            $fontSize = 14.5;
            //设置字体颜色，随机颜色
            $fontColor = imagecolorallocate($image, rand(0,120),rand(0,120), rand(0,120));      //0-120深颜色
            //设置数字
            $num = rand(0,9);
            //10>.=连续定义变量
            $captcha_code .= $num;
            //设置坐标
            $x = ($i*100/4)+rand(5,10);
            $y = rand(5,10);
            imagestring($image,$fontSize,$x,$y,$num,$fontColor);
//            imagettftext($image,$fontSize,10,$x,$y,$fontColor,$font='./123.ttf',$captcha_code);
        }
        //10>存到session
        $_SESSION['verificationCode'] = $captcha_code;
        //8>增加干扰元素，设置雪花点
        for($i=0;$i<200;$i++){
            //设置点的颜色，50-200颜色比数字浅，不干扰阅读
            $pointcolor = imagecolorallocate($image,rand(50,200), rand(50,200), rand(50,200));
            //imagesetpixel — 画一个单一像素
            imagesetpixel($image, rand(1,99), rand(1,29), $pointcolor);
        }
        //9>增加干扰元素，设置横线
        for($i=0;$i<4;$i++){
            //设置线的颜色
            $linecolor = imagecolorallocate($image,rand(80,220), rand(80,220),rand(80,220));
            //设置线，两点一线
            imageline($image,rand(1,99), rand(1,29),rand(1,99), rand(1,29),$linecolor);
        }

        //2>设置头部，image/png
        header('Content-Type: image/png');
        //3>imagepng() 建立png图形函数
        imagepng($image);
        //4>imagedestroy() 结束图形函数 销毁$image
        imagedestroy($image);

    }

    //生成验证码,可改变验证码大小
    function code(){
        session_start();
        $img=imagecreatetruecolor(200,50); //创建画布
        //$bgimg=imagecreatefromjpeg("backgroud/background".rand(1,8).'.jpg'); //生成背景图片
        //$bg_x=rand(0,130); //随机招贴画布起始X轴坐标
        //$bg_y=rand(0,55); //随机招贴画布起始Y轴坐标
        //imagecopy($img,$bgimg,0,0,$bg_x,$bg_y,$bg_x+70,$bg_y+25); //把背景图片$bging粘贴的画布上
        //生成随机字符串
        $bgColor = imagecolorallocate($img,255,255,255); //#ffffff
        //6>区域填充 int imagefill(int im, int x, int y, int col) (x,y) 所在的区域着色,col 表示欲涂上的颜色
        imagefill($img, 0, 0, $bgColor);

        function createStr($len){
            $arr1=range(0,9);
            $arr2=range('a','z');
            $arr3=range('A','Z');
            $arr=array_merge($arr1,$arr2,$arr3);
            $str="";
            for($i=0;$i<$len;$i++){
                $str.=$arr[rand(0,61)];
            }
            return $str;
        }
        $font='../font.ttf'; //字体
        $str=createStr(4); //字符串
        $_SESSION['verificationCode'] = $str;
        for($i=0;$i<4;$i++){
            $array = array(-1,1);
            $p = array_rand($array);
            $an = 1; //扭曲角度
            $size = 28;//字体大小
            $x = ($i*200/4)+rand(5,10);
            $y = rand(25,30);
            $fontColor = imagecolorallocate($img, rand(0,120),rand(0,120), rand(0,120));
            imagettftext($img, $size, $an, $x,$y,$fontColor, $font, $str[$i]);//生成验证字符窜
        }

        for($i=0;$i<300;$i++){
            //设置点的颜色，50-200颜色比数字浅，不干扰阅读
            $pointColor = imagecolorallocate($img,rand(50,200), rand(50,200), rand(50,200));
            //imagesetpixel — 画一个单一像素
            imagesetpixel($img, rand(1,200), rand(1,50), $pointColor);
        }
        //9>增加干扰元素，设置横线
        for($i=0;$i<4;$i++){
            //设置线的颜色
            $lineColor = imagecolorallocate($img,rand(80,220), rand(80,220),rand(80,220));
            //设置线，两点一线
            imageline($img,rand(1,99), rand(1,29),rand(1,99), rand(1,29),$lineColor);
        }
        header('Content-type:image/png');
        imagepng($img);
        imagedestroy($img);

}
