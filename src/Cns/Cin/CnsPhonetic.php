<?php

namespace Cns\Cin;

class CnsPhonetic extends \Cns\Base\Object {

	protected $_Pool = array();

	protected $_Chardef_Begin = '%chardef begin';
	protected $_Chardef_End = '%chardef end';


	protected $_Keyname_Begin = '%keyname begin';
	protected $_Keyname_End = '%keyname end';

	protected $_SaveFilePath = The_Cin_File_Path;

	public function run()
	{
		$this->load();
		//var_dump($this->_Pool);

		//這個是有排序的版本，會多跑幾次迴圈。

		$rtn = '';

		$rtn .= $this->createHeadBlock();
		$rtn .= $this->createKeynameBlock();

		$rtn .= $this->_Chardef_Begin;
		$rtn .= PHP_EOL;

		foreach ($this->_Pool as $index => $list) {
			foreach ($list as $i => $item) {
				$key = $item['key'];
				$val = $item['val'];

				$rtn .= $key;
				$rtn .= "\t";
				$rtn .= $val;
				$rtn .= PHP_EOL;
			}
		}

		$rtn .= $this->_Chardef_End;
		$rtn .= PHP_EOL;

		file_put_contents($this->_SaveFilePath, $rtn);

	}

	public function setSaveFilePath($val)
	{
		$this->_SaveFilePath = $val;

		return $this;
	}


	protected function load()
	{
		$rtn = array();
		$list = file(The_Cns_Phonetic_File_Path); //http://php.net/manual/en/function.file.php

		$container = $this->getContainer();
		$util = $container->getUtil();
		$cns2uni = $container->getCns2Uni();
		$phonetic = $container->getPhonetic();

		foreach ($list as $index => $line) {

			$col = $util->findCol($line);

			$cnsKey = $col[0] . '-' . $col[1];

			$val = $cns2uni->mapStr($cnsKey);
			$key = $phonetic->mapPhonetic($col[2]);

			if (!array_key_exists($key, $rtn)) {
				$rtn[$key] = array();
			}

			$item = array();
			$item['key'] = $key;
			$item['val'] = $val;

			$rtn[$key][] = $item;

		}

		$this->_Pool = $rtn;

		//return $rtn;
	}


	protected function createHeadBlock()
	{
		// 這一段沒研究，只是照抄「CnsPhonetic2014-04.cin」
		// https://www.openfoundry.org/of/download_path/cnsphone2010/10.3/CnsPhonetic2014-04.zip
		// https://www.openfoundry.org/of/projects/1603/download
		$rtn = '';
		$rtn .= '%gen_inp' . PHP_EOL;
		$rtn .= '%ename CnsPhonetic' . PHP_EOL;
		$rtn .= '%cname 全字庫注音' . PHP_EOL;
		$rtn .= '%selkey 1234567890' . PHP_EOL;
		$rtn .= '%endkey 3467' . PHP_EOL;

		return $rtn;
	}

	protected function createKeynameBlock()
	{
		$rtn = '';
		$rtn .= $this->_Keyname_Begin;
		$rtn .= PHP_EOL;

		$phonetic = $this->getContainer()->getPhonetic();
		$list = $phonetic->getMap();

		foreach ($list as $key => $val) {
			$rtn .= $val;
			$rtn .= "\t";
			$rtn .= $key;
			$rtn .= PHP_EOL;
		}

		$rtn .= $this->_Keyname_End;
		$rtn .= PHP_EOL;

		return $rtn;
	}



	public function demo()
	{



	}

} // End Class
