<?php
//若以下代码有错或不足，请在评论中指出
$img=imagecreatetruecolor(200,50); //创建画布
//$bgimg=imagecreatefromjpeg("backgroud/background".rand(1,8).'.jpg'); //生成背景图片
//$bg_x=rand(0,130); //随机招贴画布起始X轴坐标
//$bg_y=rand(0,55); //随机招贴画布起始Y轴坐标
//imagecopy($img,$bgimg,0,0,$bg_x,$bg_y,$bg_x+70,$bg_y+25); //把背景图片$bging粘贴的画布上
//生成随机字符串
function creaStr($len){
    $arr1=range(0,9);
    $arr2=range('a','z');
    $arr3=range('A','Z');
    $arr=array_merge($arr1,$arr2,$arr3);
    $str = json_encode($arr);
    str_shuffle($str);
    $str="";
    for($i=0;$i<$len;$i++){
        $str.=$arr[rand(0,61)];
    }
    return $str;
}
$font='./123.ttf'; //字体
$str=creaStr(4); //字符串
//var_dump($str);exit;
for($i=0,$j=5;$i<4;$i++){
    $array = array(-1,1);
    $p = array_rand($array);
    $an = 1; //扭曲角度
    $size = 28;//字体大小
    $x = ($i*200/4)+rand(5,10);
    $y = rand(25,30);
    $fontColor = imagecolorallocate($img, rand(0,120),rand(0,120), rand(0,120));
    imagettftext($img, $size, $an, $x,$y,$fontColor, $font, $str[$i]);//生成验证字符窜
    $j+=15;
}
header('Content-type:image/png');
imagepng($img);
imagedestroy($img);