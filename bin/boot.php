<?php
	require_once(dirname(__DIR__) . '/vendor/autoload.php');

	ini_set('memory_limit', '2048M');

	define('The_Root_Dir_Path', dirname(__DIR__));
	define('The_Asset_Dir_Path', The_Root_Dir_Path . '/asset');
	define('The_Var_Dir_Path', The_Root_Dir_Path . '/var');

	define('The_Cns_Dir_Path', The_Asset_Dir_Path . '/CNS11643');

	define('The_Cns_Table_Unicode_Dir_Path', The_Cns_Dir_Path . '/MapingTables/Unicode');
	define('The_Cns_Table_Cns2Uni_2_File_Path', The_Cns_Table_Unicode_Dir_Path . '/CNS2UNICODE_Unicode 2.txt');
	define('The_Cns_Table_Cns2Uni_15_File_Path', The_Cns_Table_Unicode_Dir_Path . '/CNS2UNICODE_Unicode 15.txt');
	define('The_Cns_Table_Cns2Uni_Bmp_File_Path', The_Cns_Table_Unicode_Dir_Path . '/CNS2UNICODE_Unicode BMP.txt');

	define('The_Cns_Properties_Dir_Path', The_Cns_Dir_Path . '/Properties');
	define('The_Cns_Phonetic_File_Path', The_Cns_Properties_Dir_Path . '/CNS_phonetic.txt');

	define('The_Cin_File_Path', The_Var_Dir_Path . '/CnsPhonetic.cin');

	define('The_Unicode_Src_File_Path', The_Var_Dir_Path . '/Unicode.list');
	define('The_Unicode_Des_File_Path', The_Var_Dir_Path . '/Unicode.txt');

	//var_dump(The_Cns_Phonetic_File_Path);
