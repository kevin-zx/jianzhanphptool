<?php
//记录路径，能够用来生成连接
session_start();
$_SESSION['name']="ypage";
$cur_dir=".";

while (true) {
	$tmp = get($cur_dir);
	if ($tmp) {
		$cur_dir = $cur_dir."/".$tmp;
		if (is_file($cur_dir)) {
			file_put_contents("test.txt", $cur_dir."\r\n", FILE_APPEND);
			break;
		}
	}else{
		break;
	}
}

function get($cur_dir){
	if (!is_dir($cur_dir)) {
		return false;
	}else{
		$file = scandir($cur_dir);
		
		$index = rand(0,count($file)-1);
		
		$tdir = $cur_dir."/".$file[$index];
		$i = 100;
		while(strstr($tdir, "index")||strstr($tdir, "list")||strpos($tdir, "..")!== false||strpos($tdir, "/.")!== false||"./."==$tdir||"./.."==$tdir||"./360_files"==$tdir||"./innerpage"==$tdir||(count(explode("/", $tdir))==2&&is_file($tdir))){
			$i = $i - 1;
			if($i<0){
				return false;
			}
			$index = rand(0,count($file)-1);
			$tdir = $cur_dir."/".$file[$index];
		}
		return $file[$index];	
	}
}
?>

<a href="" id="hufe"></a>

<script type="text/javascript">
// 	function GetRandomNum(Min,Max)
// 	{   
// 		var Range = Max - Min;   
// 		var Rand = Math.random();   
// 		return(Min + Math.round(Rand * Range));   
// 	}   
// 	var a = ["http://www.523club.com/a/zhongyijibing/changjianjibing/20140330/163.html",
// "http://www.523club.com/a/shenghuoyangsheng/qiwenbagua/2019/1213/237.html",
// "http://www.523club.com/a/zhongyijibing/fukejibing/20191212/26.html",
// "http://www.523club.com/a/zhongyiyangsheng/yangshengwuqu/2014/0330/48.html",
// "http://www.523club.com/a/zhongyiyangsheng/yangshengtuku/2019/1213/106.html",
// "http://www.523club.com/a/shenghuoyangsheng/qiwenbagua/2014/0330/235.html",
// "http://www.523club.com/a/shenghuoyangsheng/sijishiliao/2017/0224/254.html",
// "http://www.523club.com/a/zhongyiyangsheng/2017/0224/244.html",
// "http://www.523club.com/a/zhongyiyangsheng/jinriyangsheng/2014/0330/82.html",
// "http://www.523club.com/a/zhongyijibing/ganshenjibing/20191213/213.html",
// "http://www.523club.com/a/zhongyijibing/ganshenjibing/20170224/258.html",
// "http://www.523club.com/a/zhongyijibing/nankejibing/20191212/29.html",
// "http://www.523club.com/a/shenghuoyangsheng/sijishiliao/2014/0330/132.html",
// "http://www.523club.com/a/shenghuoyangsheng/xingfuyaoshan/2019/1213/146.html",
// "http://www.523club.com/a/zhongyijibing/xinnaojibing/20170312/262.html",
// "http://www.523club.com/a/zhongyijibing/ganshenjibing/20191213/204.html",
// "http://www.523club.com/a/zhongyiyangsheng/yangshengkexue/2014/0330/41.html",
// "http://www.523club.com/a/zhongyijibing/changjianjibing/20191213/164.html",
// "http://www.523club.com/a/shenghuoyangsheng/qiwenbagua/2019/1213/230.html",
// "http://www.523club.com/a/zhongyijibing/nankejibing/20191213/201.html",
// "http://www.523club.com/a/zhongyiyangsheng/teseliaofa/2014/0330/77.html",
// "http://www.523club.com/a/shenghuoyangsheng/yinshijinji/2019/1212/15.html",
// "http://www.523club.com/a/zhongyijibing/xinnaojibing/20191212/24.html",
// "http://www.523club.com/a/zhongyiyangsheng/jinriyangsheng/2014/0330/10.html",
// "http://www.523club.com/a/zhongyijibing/fukejibing/20191213/186.html",
// "http://www.523club.com/a/zhongyijibing/xinnaojibing/20191213/179.html",
// "http://www.523club.com/a/zhongyiyangsheng/yangshengkexue/2014/0330/3.html",
// "http://www.523club.com/a/zhongyijibing/xinnaojibing/20170224/257.html",
// "http://www.523club.com/a/shenghuoyangsheng/qiwenbagua/2019/1213/234.html",
// "http://www.523club.com/a/zhongyijibing/piweijibing/20191212/31.html",
// "http://www.523club.com/a/zhongyijibing/changjianjibing/20191212/33.html",
// "http://www.523club.com/a/zhongyijibing/changjianjibing/20170224/252.html",
// "http://www.523club.com/a/shenghuoyangsheng/xingfuyaoshan/2019/1212/18.html",
// "http://www.523club.com/a/shenghuoyangsheng/jinghuahuida/2014/0330/160.html",
// "http://www.523club.com/a/shenghuoyangsheng/meirishipu/2014/0330/116.html",
// "http://www.523club.com/a/shenghuoyangsheng/yinshijinji/2017/0224/260.html",
// "http://www.523club.com/a/shenghuoyangsheng/sijishiliao/2014/0330/131.html",
// "http://www.523club.com/a/zhongyiyangsheng/teseliaofa/2014/0330/79.html",
// "http://www.523club.com/a/zhongyiyangsheng/yangshengtuku/2014/0330/96.html",
// "http://www.523club.com/a/zhongyijibing/piweijibing/20191213/222.html",
// "http://www.523club.com/a/zhongyijibing/ganshenjibing/20170224/256.html",
// "http://www.523club.com/a/zhongyijibing/piweijibing/20140330/30.html",
// "http://www.523club.com/a/zhongyiyangsheng/yangshengtuku/2014/0330/101.html",
// "http://www.523club.com/a/shenghuoyangsheng/sijishiliao/2019/1213/139.html",
// "http://www.523club.com/a/shenghuoyangsheng/xingfuyaoshan/2019/1213/144.html",
// "http://www.523club.com/a/zhongyijibing/ganshenjibing/20140330/202.html",
// "http://www.523club.com/a/zhongyiyangsheng/jinriyangsheng/2014/0330/86.html",
// "http://www.523club.com/a/zhongyiyangsheng/jinriyangsheng/2019/1212/10.html",
// "http://www.523club.com/a/shenghuoyangsheng/sijishiliao/2017/0224/251.html",
// "http://www.523club.com/a/zhongyiyangsheng/jinriyangsheng/2014/0330/81.html",
// "http://www.523club.com/a/shenghuoyangsheng/xingfuyaoshan/2019/1213/148.html",
// "http://www.523club.com/a/zhongyijibing/ganshenjibing/20140330/212.html",
// "http://www.523club.com/a/shenghuoyangsheng/qiwenbagua/2014/0330/236.html",
// "http://www.523club.com/a/shenghuoyangsheng/meirishipu/2019/1213/116.html",
// "http://www.523club.com/a/zhongyiyangsheng/yannianyishou/2014/0330/62.html",
// "http://www.523club.com/a/zhongyijibing/piweijibing/20140330/216.html",
// "http://www.523club.com/a/zhongyiyangsheng/teseliaofa/2019/1212/8.html",
// "http://www.523club.com/a/shenghuoyangsheng/sijishiliao/2019/1213/133.html",
// "http://www.523club.com/a/shenghuoyangsheng/xingfuyaoshan/2019/1213/149.html",
// "http://www.523club.com/a/shenghuoyangsheng/xingfuyaoshan/2019/1213/141.html"];

// 	var href =document.getElementById('hufe');
// 	href.setAttribute("href",a[GetRandomNum(0,a.length-1)]);
// 	document.querySelector('#hufe').click();
function myrefresh() 
{ 
window.location.reload(); 
} 
//setTimeout('myrefresh()',500); //指定1秒刷新一次 
</script>
