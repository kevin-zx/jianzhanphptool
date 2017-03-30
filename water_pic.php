<?php 
//生成水印
set_time_limit(0);
$handler = opendir('./2016021810/');

//2、循环的读取目录下的所有文件
//其中$filename = readdir($handler)是每次循环的时候将读取的文件名赋值给$filename，为了不陷于死循环，所以还要让$filename !== false。一定要用!==，因为如果某个文件名如果叫’0′，或者某些被系统认为是代表false，用!=就会停止循环*/

while( ($filename = readdir($handler)) !== false ) {
      //3、目录下都会有两个文件，名字为’.'和‘..’，不要对他们进行操作
  if($filename != "." && $filename != ".."){
          //4、进行处理
      // echo $filename ."<br>";
  	watermark("./2016021810/".$filename , "w.jpg",true,5);
  }
}

//5、关闭目录
closedir($handler);
// 

function watermark($desImg,$waterImg,$positon=1,$saveas=false,$alpha=100) 
{ 
    //获取目图片的基本信息 
    $temp=pathinfo($desImg); 
    // var_dump($temp);
    $name=$temp["basename"];//<SPAN class=t_tag onclick=tagshow(event) href="tag.php?name=%CE%C4%BC%FE">文件</SPAN>名 
    $path=$temp["dirname"];//文件所在的文件夹 
    $extension=$temp["extension"];//文件扩展名 
    if($saveas) 
    { 
        //需要另存为 
        $name=rtrim($name,".$extension").".";//重新命名 
        $savepath=$path."/".$name.$extension; 
    } 
    else
    { 
    //不需要另存为则覆盖原图 
        $savepath=$path."/".$name; 
    } 
    $info=getImageInfo($desImg);//获取目标图片的信息 
    $info2=getImageInfo($waterImg);//获取水印图片的信息 
    $width_rate = 2.5;
    $height_rate = 6;
    $info2[0] = $info[0]/$width_rate;
    $info2[1] = $info[1]/$height_rate;
    // resize($waterImg,$info[0]/3,$info[0]/7);
    $desImg=create($desImg);//从原图创建 
    // $waterImg=create($waterImg);//从水印图片创建 
    $waterImg=resize($waterImg,$info[0]/$width_rate,$info[1]/$height_rate);
    //位置1：顶部居左 
    if($positon==1) 
    { 
        $x=0; 
        $y=0; 
    } 
    //位置2：顶部居右 
    if($positon==2) 
    { 
        $x=$info[0]-$info2[0]; 
        $y=0; 
    } 
    //位置3：居中 
    if($positon==3) 
    { 
        $x=($info[0]-$info2[0])/2; 
        $y=($info[1]-$info2[1])/2; 
    } 
    //位置4：底部居左 
    if($positon==4) 
    { 
        $x=0; 
        $y=$info[1]-$info2[1]; 
    } 
    //位置5：底部居右 
    if($positon==5) 
    { 
        $x=$info[0]-$info2[0]; 
        $y=$info[1]-$info2[1]; 
    } 
    imagecopymerge($desImg,$waterImg,$x,$y,0,0,$info2[0],$info2[1],$alpha); 
    imagejpeg($desImg,$savepath); 
    imagedestroy($desImg); 
    imagedestroy($waterImg); 
    return $savepath; 
} 
/** 
* 获取图片的信息，width,height,image/type 
* @param string $src 图片路径 
* @return <SPAN class=t_tag onclick=tagshow(event) href="tag.php?name=%CA%FD%D7%E9">数组</SPAN> 
* **/
function getImageInfo($src) 
{ 
    return getimagesize($src); 
} 
/** 
* 创建图片，返回资源类型 
* @param string $src 图片路径 
* @return resource $im 返回资源类型  
* **/
function create($src) 
{ 
    $info=getImageInfo($src); 
    switch ($info[2]) 
    { 
        case 1: 
        $im=imagecreatefromgif($src); 
        break; 
        case 2: 
        $im=imagecreatefromjpeg($src); 
        break; 
        case 3: 
        $im=imagecreatefrompng($src); 
        break; 
    } 
    return $im; 
} 
/** 
* 缩略图主函数 
* @param string $src 图片路径 
* @param int $w 缩略图宽度 
* @param int $h 缩略图高度 
* @return mixed 返回缩略图路径 
* **/

function resize($src,$w,$h) 
{ 
    $temp=pathinfo($src); 
    $name=$temp["basename"];//文件名 
    $dir=$temp["dirname"];//文件所在的文件夹 
    $extension=$temp["extension"];//文件扩展名 
    $savepath="{$dir}/{$name}.thumb.jpg";//缩略图保存路径,新的文件名为*.thumb.jpg 

    //获取图片的基本信息 
    $info=getImageInfo($src); 
    $width=$info[0];//获取图片宽度 
    $height=$info[1];//获取图片高度 
    $per1=round($width/$height,2);//计算原图长宽比 
    $per2=round($w/$h,2);//计算缩略图长宽比 

    //计算缩放比例 
    if($per1>$per2||$per1==$per2) 
    { 
    //原图长宽比大于或者等于缩略图长宽比，则按照宽度优先 
        $per=$w/$width; 
    } 
    if($per1<$per2) 
    { 
    //原图长宽比小于缩略图长宽比，则按照高度优先 
        $per=$h/$height; 
    } 
    $temp_w=intval($width*$per);//计算原图缩放后的宽度 
    $temp_h=intval($height*$per);//计算原图缩放后的高度 
    $temp_img=imagecreatetruecolor($temp_w,$temp_h);//创建画布 
    $im=create($src); 
    imagecopyresampled($temp_img,$im,0,0,0,0,$temp_w,$temp_h,$width,$height); 
    if($per1>$per2) 
    { 
        imagejpeg($temp_img,$savepath); 
        return addBg($savepath,$w,$h,"w"); 
    //宽度优先，在缩放之后高度不足的情况下补上背景 
    } 
    if($per1==$per2) 
    { 
        imagejpeg($temp_img,$savepath); 
        return $temp_img; 
    //等比缩放 
    } 
    if($per1<$per2) 
    { 
        imagejpeg($temp_img,$savepath); 

        return addBg($savepath,$w,$h,"h"); 
    //高度优先，在缩放之后宽度不足的情况下补上背景 
    } 
} 
/** 
* 添加背景 
* @param string $src 图片路径 
* @param int $w 背景图像宽度 
* @param int $h 背景图像高度 
* @param String $first 决定图像最终位置的，w 宽度优先 h 高度优先 wh:等比 
* @return 返回加上背景的图片 
* **/
function addBg($src,$w,$h,$fisrt="w") 
{ 
    $bg=imagecreatetruecolor($w,$h); 
    $white = imagecolorallocate($bg,255,255,255); 
    imagefill($bg,0,0,$white);//填充背景 

    //获取目标图片信息 
    $info=getImageInfo($src); 
    $width=$info[0];//目标图片宽度 
    $height=$info[1];//目标图片高度 
    $img=create($src); 
    if($fisrt=="wh") 
    { 
    //等比缩放 
        return $src; 
    } 
    else 
    { 
        if($fisrt=="w") 
        { 
            $x=0; 
        $y=($h-$height)/2;//垂直居中 
    } 
    if($fisrt=="h") 
    { 
            $x=($w-$width)/2;//水平居中 
            $y=0; 
        } 
        imagecopymerge($bg,$img,$x,$y,0,0,$width,$height,100); 
        // imagejpeg($bg,$src); 
        // imagedestroy($bg); 
        // imagedestroy($img); 
        return $bg; 
    } 

}

?>