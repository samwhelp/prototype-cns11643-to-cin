<?php

namespace Cns\Base;

class Container {

	public static $_Instance = null;

	public static function getInstance()
	{
		if (self::$_Instance === null) {
			self::$_Instance = self::newInstance();
		}
		return self::$_Instance;
	}

	public static function newInstance()
	{
		return new Container();
	}

	protected $_Util = null;
	public function getUtil()
	{
		if ($this->_Util === null) {
			$this->_Util = new \Cns\Base\Util;
		}

		return $this->_Util;
	}

	protected $_Unicode = null;
	public function getUnicode()
	{
		if ($this->_Unicode === null) {
			$this->_Unicode = new \Cns\Map\Unicode;
		}

		return $this->_Unicode;
	}


	protected $_Phonetic = null;
	public function getPhonetic()
	{
		if ($this->_Phonetic === null) {
			$this->_Phonetic = new \Cns\Map\Phonetic;
		}

		return $this->_Phonetic;
	}


	protected $_Cns2Uni = null;
	public function getCns2Uni()
	{
		if ($this->_Cns2Uni === null) {
			$this->_Cns2Uni = new \Cns\Map\Cns2Uni;
		}

		return $this->_Cns2Uni;
	}


	protected $_CinCnsPhonetic = null;
	public function getCinCnsPhonetic()
	{
		if ($this->_CinCnsPhonetic === null) {
			$this->_CinCnsPhonetic = new \Cns\Cin\CnsPhonetic;
		}

		return $this->_CinCnsPhonetic;
	}


	protected $_UnicodeBatch = null;
	public function getUnicodeBatch()
	{
		if ($this->_UnicodeBatch === null) {
			$this->_UnicodeBatch = new \Cns\Batch\Unicode;
		}

		return $this->_UnicodeBatch;
	}


} // End Class
