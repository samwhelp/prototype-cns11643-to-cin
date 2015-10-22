<?php

namespace Cns\Map;

class Unicode extends \Cns\Base\Object {


	public function code2utf($num)
	{
		$num = base_convert($num, 16, 10); //http://php.net/manual/en/function.base-convert.php
		return $this->numb2utf($num);
	}

	public function numb2utf($num)
	{
		//這個funtion的內容，是從「http://php.net/manual/en/function.utf8-encode.php#58442」複製下來的，原名是「code2utf」。

		if ($num<128) return chr($num);
		if ($num<2048) return chr(($num>>6)+192) . chr(($num&63)+128);
		if ($num<65536) return chr(($num>>12)+224) . chr((($num>>6)&63)+128) . chr(($num&63)+128);
		if ($num<2097152) return chr(($num>>18)+240) . chr((($num>>12)&63)+128) . chr((($num>>6)&63)+128) . chr(($num&63)+128);
		return '';
	}

	public function demo()
	{
		//var_dump($this->code2utf('6E2C'));
		//var_dump($this->numb2utf('4923'));
	}

} // End Class
