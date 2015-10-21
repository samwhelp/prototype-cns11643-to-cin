<?php

namespace Cns\App;

class Cin extends \Cns\Base\Object {

	public function run()
	{

		$act = $this->getContainer()->getCinCnsPhonetic()
			->setSaveFilePath(The_Cin_File_Path)
			->run()
		;

	}
} // End Class
