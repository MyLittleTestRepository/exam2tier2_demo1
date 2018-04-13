<?
//include
if (file_exists(dirname(__FILE__).'/include/EventHandler.php'))
	require_once dirname(__FILE__).'/include/EventHandler.php';

//отладочная функция, пишет в файл /debug_$fname.txt массивы и переменные
function mydebug($str=false,$die=false,$fname='')
{
	$file=$_SERVER['DOCUMENT_ROOT'].'/debug_'.$fname.'.txt';
	$data=date('H:i:s').PHP_EOL.mydump($str);
	file_put_contents($file,$data);
	($die)?die():'';
}