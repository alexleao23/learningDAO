<?php 

spl_autoload_register(function($className){
	$className = str_replace('\\', DIRECTORY_SEPARATOR, $className);
	$fileName = "Class" .DIRECTORY_SEPARATOR . $className . ".php";

	if (file_exists($fileName)) {
		require_once ($fileName);
	}
});

 ?>