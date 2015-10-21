<?php

namespace Cns\Batch;

class Unicode extends \Cns\Base\Object {

	protected $_SrcFilePath = The_Unicode_Src_File_Path;

	public function setSrcFilePath($val)
	{
		$this->_SrcFilePath = $val;

		return $this;
	}

	protected $_DesFilePath = The_Unicode_Src_File_Path;

	public function setDesFilePath($val)
	{
		$this->_DesFilePath = $val;

		return $this;
	}

	public function run()
	{
		$rtn = '';

		$src = $this->_SrcFilePath;
		$des = $this->_DesFilePath;

		$list = file($src);

		$unicode = $this->getContainer()->getUnicode();

		foreach((array) $list as $key => $val) {
			$val = trim($val);

			if (!$val) {
				continue;
			}

			$rtn .= $unicode->code2utf($val);
			$rtn .= PHP_EOL;
		}

		file_put_contents($des, $rtn);

	}

} // End Class
