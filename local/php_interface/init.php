<?
//отладочная функция, пишет в файл /debug_$fname.txt массивы и переменные
function mydebug(&$string, $die = false, $fname = '')
{
	file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/debug_' . $fname . '.txt',
	                  date('H:i:s') . PHP_EOL . mydump($string));
	if ($die)
		die();
}
