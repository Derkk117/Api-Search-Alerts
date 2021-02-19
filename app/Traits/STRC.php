<?php

namespace App\Traits;

trait STRC
{
	function mb_ucfirst($string, $encoding)
	{
		$string = mb_convert_case($string, MB_CASE_LOWER);
    	$strlen = mb_strlen($string, $encoding);
    	$firstChar = mb_substr($string, 0, 1, $encoding);
    	$then = mb_substr($string, 1, $strlen - 1, $encoding);
    	return mb_strtoupper($firstChar, $encoding) . $then;
	}
}
