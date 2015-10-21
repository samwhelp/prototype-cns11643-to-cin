<?php

namespace Cns\Map;

class Phonetic extends \Cns\Base\Object {

	protected $_Map = array(
		'ˇ' => '3',
		'ˊ' => '6',
		'ˋ' => '4',
		'˙' => '7',
		'ㄅ' => '1',
		'ㄆ' => 'q',
		'ㄇ' => 'a',
		'ㄈ' => 'z',
		'ㄉ' => '2',
		'ㄊ' => 'w',
		'ㄋ' => 's',
		'ㄌ' => 'x',
		'ㄍ' => 'e',
		'ㄎ' => 'd',
		'ㄏ' => 'c',
		'ㄐ' => 'r',
		'ㄑ' => 'f',
		'ㄒ' => 'v',
		'ㄓ' => '5',
		'ㄔ' => 't',
		'ㄕ' => 'g',
		'ㄖ' => 'b',
		'ㄗ' => 'y',
		'ㄘ' => 'h',
		'ㄙ' => 'n',
		'ㄚ' => '8',
		'ㄛ' => 'i',
		'ㄜ' => 'k',
		'ㄝ' => ',',
		'ㄞ' => '9',
		'ㄟ' => 'o',
		'ㄠ' => 'l',
		'ㄡ' => '.',
		'ㄢ' => '0',
		'ㄣ' => 'p',
		'ㄤ' => ';',
		'ㄥ' => '/',
		'ㄦ' => '-',
		'ㄧ' => 'u',
		'ㄨ' => 'j',
		'ㄩ' => 'm',
	);

	public function getMap()
	{
		return $this->_Map;
	}


	public function mapPhoneticKey($char)
	{
		//http://php.net/manual/en/function.array-key-exists.php
		if (!array_key_exists($char, $this->_Map)) {
			return '';
		}

		return $this->_Map[$char];
	}

	public function mapPhonetic($str)
	{
		//http://php.net/manual/en/language.types.string.php
		//http://php.net/manual/en/function.mb-substr.php
		//http://php.net/manual/en/function.mb-strlen.php

		$rtn = '';
		$len = mb_strlen($str, 'UTF-8');
		for ($i=0; $i<$len; $i++) {
			$char = mb_substr($str, $i, 1, 'UTF-8');
			$rtn .= $this->mapPhoneticKey($char);
		}

		return $rtn;
	}


	public function demo()
	{
		//var_dump(__METHOD__);
		//var_dump($this->mapPhoneticKey('ㄘ'));
		//var_dump($this->mapPhonetic('ㄘㄜˋ'));
	}
} // End Class
