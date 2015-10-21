<?php

namespace Cns\Base;

class Util extends \Cns\Base\Object {

	public function findCol($line)
	{
		//http://php.net/manual/en/function.explode.php
		$line = trim($line);
		$rtn = explode("\t", $line);
		return $rtn;
	}

	public function run()
	{
		var_dump(__METHOD__);
	}
} // End Class
