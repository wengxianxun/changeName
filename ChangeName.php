 
<?php
header("Content-Type: text/html;charset=utf-8");  
define("FILE_PATH",dirname(__FILE__)."/QQWork"); 
 
$urlnewprefix = $_GET['newprefix'];
$urloldprefix = $_GET['oldprefix'];
function getSize($dirName,$newprefix,$oldprefix)
{
	echo $oldprefix.'->'.$newprefix.'<br/>';
	$echoLine = '----';
	echo $echoLine.'<br/>';
	 
	echo $echoLine."即将为你修改".$dirName."下的文件名<br/>";
	//打开
	$handle=opendir($dirName); 

	if($handle){  

			echo $echoLine.'打开文件，准备开始批量修改'.$handle.'<br/>';
		
			while (false !== ($file = readdir($handle))) { 
				if($file!="." && $file!='..'){ 
					if ($file == '.svn') {
						echo $echoLine.$file.'<br/>';
						
					}else{
						$file_path =  $dirName.'/'.$file;

						if(is_dir($file_path)){ 
							//是目录
							echo $echoLine."开始修改：".$file_path."<br/>"; 
							getSize($file_path,$newprefix,$oldprefix);
						}else{  
							echo $echoLine.$file.'<br/>';

							$oldname = $dirName.'/'.$file;
							//使用新前缀替换旧前缀
							$newname = $dirName.'/'.str_replace($oldprefix, $newprefix, $file);
							if(rename($oldname,$newname)){
								echo '修改成功'.$file.':::::'.$oldprefix.'->'.$newprefix.'<br/>';
								// echo '修改成功'.$oldname.'->'.$newname.'<br/>';
							}else{
								echo '注意：错误请查看修改的目录权限问题';
							} 
						}

					}
					 
				} 
			}  
	}
}

getSize(FILE_PATH,$urlnewprefix,$urloldprefix);  









	 