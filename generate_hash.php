<?php
function generateHash()
{
		$RandomStr = base64_encode(microtime());
		$ResultStr = md5(substr($RandomStr,0,20));
		$ResultStr = strtolower($ResultStr);
		return $ResultStr;
}
?>