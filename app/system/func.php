<?php

function e($string)
{
	return htmlentities($string);
}

function dd($value)
{
	echo "<pre>";
	var_dump($value);
	echo "</pre>";
	exit;
}

function str_random($limit = 5)
{
	$alpha = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$result = '';

	for ($i = 0; $i <= $limit; $i++)
	{ 
		$result .= $alpha[rand(0, strlen($alpha) -1)];
	}

	return $result;
}

function token()
{
	return Session::token();
}

function timeago($timestamp)
{
	$time = time() - $timestamp;

	if ($time < 60)
		return  ( $time > 1 ) ? $time . ' seconds' : 'a second';
	
	elseif ($time < 3600) {
		$tmp = floor($time / 60);
		return ($tmp > 1) ? $tmp . ' minutes' : ' a minute';
	}
	
	elseif ($time < 86400) {
		$tmp = floor($time / 3600);
		return ($tmp > 1) ? $tmp . ' hours' : ' a hour';
	}
	
	elseif ($time < 2592000) {
		$tmp = floor($time / 86400);
		return ($tmp > 1) ? $tmp . ' days' : ' a day';
	}
	
	elseif ($time < 946080000) {
		$tmp = floor($time / 2592000);
		return ($tmp > 1) ? $tmp . ' months' : ' a month';
	}
	
	else {
		$tmp = floor($time / 946080000);
		return ($tmp > 1) ? $tmp . ' years' : ' a year';
	}
}

function bytes($byte)
{
	if ($byte < 1024)
		return number_format(($byte), 2, '.', '') ." bite";
	
	elseif ($byte < 1048576)
		return number_format(($byte/1024), 2, '.' ,'') ." kb";
	
	elseif ($byte < 1073741824)
		return number_format(($byte/1048576), 2, '.', '') ." mb";
	
	elseif($byte < 1099511627776)
		return number_format(($byte/1073741824), 2, '.', '') ." gb";
	
	else
		return number_format(($byte/1099511627776), 2, '.', '') ." tb";
}

?>