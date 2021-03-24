<html>
<head>
<title>PET - old pictures</title>
<style type="text/css">
	figure {
		float: left;
	}
</style>
</head>
<body>
<h1>PET - old pictures</h1>
<?
$dir="/home/pet/public_html/old/";
$skip=intval($_GET['s']);
$num=intval($_GET['n']);
if($num==0)
	$num=20;
if(is_dir($dir) && $h=opendir($dir)){
	while(($f=readdir($h))!==false){
		if(filetype($dir.$f)=="file"){
			if(substr($f,-3)=="jpg"){
				$fs[]=$f;
			}
		}
	}
	closedir($h);
}

rsort($fs);

$i=0;
$j=0;
foreach($fs as $f){
	if($j>$num){
		printf("<br /><br/><a href=\"./list_old.php?s=$i\">next</a>");
		break;
	}
	if($i>=$skip){
		printf("<figure>");
		printf("<img src=\"/~pet/old/$f\" />\n");
		printf("<figcaption>$f</figcaption>");
		printf("</figure>");
		$j++;
	}
	$i++;
}
?>
</body>
</html>

