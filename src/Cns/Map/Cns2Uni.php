<?php

namespace Cns\Map;

class Cns2Uni extends \Cns\Base\Object {
	protected $_Map = array();

	public function __construct()
	{
		$this->load();
	}

	public function map($key)
	{
		if (!array_key_exists($key, $this->_Map)) {
			return '';
		}

		return $this->_Map[$key];
	}

	public function mapStr($key)
	{
		$num = $this->map($key);

		$unicode = $this->getContainer()->getUnicode();

		return $unicode->code2utf($num);
	}

	protected function load()
	{
		$this->loadOrigFile(The_Cns_Table_Cns2Uni_Bmp_File_Path);
		$this->loadOrigFile(The_Cns_Table_Cns2Uni_2_File_Path);
		$this->loadOrigFile(The_Cns_Table_Cns2Uni_15_File_Path);
	}

	protected function loadOrigFile($file)
	{
		if (!file_exists($file)) {
			return;
		}

		$list = file($file);

		$util = $this->getContainer()->getUtil();

		foreach ($list as $key => $line) {
			$col = $util->findCol($line);
			$key = $col[0] . '-' . $col[1];
			$val = $col[2];
			$this->_Map[$key] = $val;
		}

		//var_dump($this->_Map);
	}



	public function demo()
	{
		var_dump($this->mapStr('1-4423'));

	}
} // End class
