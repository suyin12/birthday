<?php
//若以下代码有错或不足，请在评论中指出
$img=imagecreatetruecolor(200,50); //创建画布
//$bgimg=imagecreatefromjpeg("backgroud/background".rand(1,8).'.jpg'); //生成背景图片
//$bg_x=rand(0,130); //随机招贴画布起始X轴坐标
//$bg_y=rand(0,55); //随机招贴画布起始Y轴坐标
//imagecopy($img,$bgimg,0,0,$bg_x,$bg_y,$bg_x+70,$bg_y+25); //把背景图片$bging粘贴的画布上
//生成随机字符串
$bgColor = imagecolorallocate($img,255,255,255); //#ffffff
//6>区域填充 int imagefill(int im, int x, int y, int col) (x,y) 所在的区域着色,col 表示欲涂上的颜色
imagefill($img, 0, 0, $bgColor);

function creaStr($len){
    $arr1=range(0,9);
    $arr2=range('a','z');
    $arr3=range('A','Z');
    $arr=array_merge($arr1,$arr2,$arr3);
//    $str = json_encode($arr);
//    str_shuffle($str);
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