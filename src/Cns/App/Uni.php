<?php

namespace Cns\App;

class Uni extends \Cns\Base\Object {

	public function run()
	{

		$act = $this->getContainer()->getUnicodeBatch()
			->setSrcFilePath(The_Unicode_Src_File_Path)
			->setDesFilePath(The_Unicode_Des_File_Path)
			->run()
		;

	}
} // End Class
