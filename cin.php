#!/usr/bin/env php
<?php

	/**
	 * http://www.ubuntu-tw.org/modules/newbb/viewtopic.php?post_id=326994#forumpost326994
	 * wget -c "http://data.gov.tw/iisi/logaccess/20?dataUrl=http://www.cns11643.gov.tw/AIDB/Open_Data.zip&ndctype=TXT&ndcnid=5961" -O Open_Data.zip
	 * Open_Data/Properties/全字庫屬性資料說明文件.txt
	 * 以下摘錄上面的檔案。
	 * ---------------------------------------------------
	 *「CNS_phonetic.txt」為全字庫的注音資料表格
	 * ---------------------------------------------------
	 * 第一個欄位：CNS字碼的字面(16進位)
	 * 第二個欄位：CNS字碼的編碼(16進位)
	 * 第三個欄位：該CNS字碼的注音屬性(以注音符號表示)
	 *
	 */

class Cns_Phonetic {

	protected $phoneticKeyMap = array(
		'ㄝ' => ',',
		'ㄦ' => '-',
		'ㄡ' => '.',
		'ㄥ' => '/',
		'ㄢ' => '0',
		'ㄅ' => '1',
		'ㄉ' => '2',
		'ˇ' => '3',
		'ˋ' => '4',
		'ㄓ' => '5',
		'ˊ' => '6',
		'˙' => '7',
		'ㄚ' => '8',
		'ㄞ' => '9',
		'ㄤ' => ';',
		'ㄇ' => 'a',
		'ㄖ' => 'b',
		'ㄏ' => 'c',
		'ㄎ' => 'd',
		'ㄍ' => 'e',
		'ㄑ' => 'f',
		'ㄕ' => 'g',
		'ㄘ' => 'h',
		'ㄛ' => 'i',
		'ㄨ' => 'j',
		'ㄜ' => 'k',
		'ㄠ' => 'l',
		'ㄩ' => 'm',
		'ㄙ' => 'n',
		'ㄟ' => 'o',
		'ㄣ' => 'p',
		'ㄆ' => 'q',
		'ㄐ' => 'r',
		'ㄋ' => 's',
		'ㄔ' => 't',
		'ㄧ' => 'u',
		'ㄒ' => 'v',
		'ㄊ' => 'w',
		'ㄌ' => 'x',
		'ㄗ' => 'y',
		'ㄈ' => 'z',
	);

	protected $Chardef_Begin = '%chardef begin';
	protected $Chardef_End = '%chardef end';


	protected $Keyname_Begin = '%keyname begin';
	protected $Keyname_End = '%keyname end';


	protected function findCol($line)
	{
		//http://php.net/manual/en/function.explode.php
		$line = trim($line);
		$rtn = explode("\t", $line);
		return $rtn;
	}

	protected function mapPhoneticKey($char)
	{
		//http://php.net/manual/en/function.array-key-exists.php
		if (!array_key_exists($char, $this->phoneticKeyMap)) {
			return '';
		}

		return $this->phoneticKeyMap[$char];
	}

	protected function mapPhonetic($str)
	{
		//http://php.net/manual/en/language.types.string.php
		//http://php.net/manual/en/function.mb-substr.php
		//http://php.net/manual/en/function.mb-strlen.php

		$rtn = '';
		$len = mb_strlen($str, 'UTF-8');
		for ($i=0; $i<$len; $i++) {
			$char = mb_substr($str, $i, 1, 'UTF-8');
			////var_dump($char);
			$rtn .= $this->mapPhoneticKey($char);
		}

		return $rtn;
	}



	protected function code2utf($num)
	{
		//這個funtion不確定是否正確，只是從「http://php.net/manual/en/function.utf8-encode.php#58442」複製下來，然後加入下面這一行。
		$num = base_convert($num, 16, 10); //http://php.net/manual/en/function.base-convert.php

		if($num<128)return chr($num);
	    if($num<2048)return chr(($num>>6)+192).chr(($num&63)+128);
	    if($num<65536)return chr(($num>>12)+224).chr((($num>>6)&63)+128).chr(($num&63)+128);
	    if($num<2097152)return chr(($num>>18)+240).chr((($num>>12)&63)+128).chr((($num>>6)&63)+128) .chr(($num&63)+128);
	    return '';
	}

	protected function createHeadBlock()
	{
		// 這一段沒研究，只是照抄「CnsPhonetic2014-04.cin」
		// https://www.openfoundry.org/of/download_path/cnsphone2010/10.3/CnsPhonetic2014-04.zip
		// https://www.openfoundry.org/of/projects/1603/download
		$rtn = '';
		$rtn .= '%gen_inp' . PHP_EOL;
		$rtn .= '%ename CnsPhonetic2014-04' . PHP_EOL;
		$rtn .= '%cname 全字庫注音2014-04' . PHP_EOL;
		$rtn .= '%selkey 1234567890' . PHP_EOL;
		$rtn .= '%endkey 3467' . PHP_EOL;

		return $rtn;
	}

	protected function createKeynameBlock()
	{
		$rtn = '';
		$rtn .= $this->Keyname_Begin;
		$rtn .= PHP_EOL;

		foreach ($this->phoneticKeyMap as $key => $val) {
			$rtn .= $val;
			$rtn .= "\t";
			$rtn .= $key;
			$rtn .= PHP_EOL;
		}

		$rtn .= $this->Keyname_End;
		$rtn .= PHP_EOL;

		return $rtn;
	}

	public function run()
	{
		$list = file('CNS_phonetic.txt'); //http://php.net/manual/en/function.file.php

		$rtn = '';

		$rtn .= $this->createHeadBlock();
		$rtn .= $this->createKeynameBlock();

		$rtn .= $this->Chardef_Begin;
		$rtn .= PHP_EOL;

		foreach ($list as $index => $line) {
			$cols = $this->findCol($line);

			$key = $this->mapPhonetic($cols[2]);
			$val = $this->code2utf($cols[1]);

			$rtn .= $key;
			$rtn .= "\t";
			$rtn .= $val;
			$rtn .= PHP_EOL;
		}

		$rtn .= $this->Chardef_End;
		$rtn .= PHP_EOL;

		file_put_contents('CnsPhonetic.cin', $rtn); //http://php.net/manual/en/function.file-put-contents.php
	}

	protected function loadTable()
	{
		$rtn = array();
		$list = file('CNS_phonetic.txt'); //http://php.net/manual/en/function.file.php

		foreach ($list as $index => $line) {
			$cols = $this->findCol($line);

			$key = $this->mapPhonetic($cols[2]);
			$val = $this->code2utf($cols[1]);

			if (!array_key_exists($key, $rtn)) {
				$rtn[$key] = array();
			}

			$item = array();
			$item['key'] = $key;
			$item['val'] = $val;

			$rtn[$key][] = $item;

		}

		return $rtn;
	}

	public function runSort()
	{
		//這個是有排序的版本，會多跑幾次迴圈。

		$rtn = '';

		$rtn .= $this->createHeadBlock();
		$rtn .= $this->createKeynameBlock();

		$rtn .= $this->Chardef_Begin;
		$rtn .= PHP_EOL;

		$table = $this->loadTable();

		foreach ($table as $index => $list) {
			foreach ($list as $i => $item) {
				$key = $item['key'];
				$val = $item['val'];

				$rtn .= $key;
				$rtn .= "\t";
				$rtn .= $val;
				$rtn .= PHP_EOL;
			}
		}

		$rtn .= $this->Chardef_End;
		$rtn .= PHP_EOL;

		file_put_contents('CnsPhonetic.cin', $rtn); //http://php.net/manual/en/function.file-put-contents.php
	}

} // End Class


$act = new Cns_Phonetic;
//$act->run(); // 沒有排序的版本。
$act->runSort(); //有排序的版本。
