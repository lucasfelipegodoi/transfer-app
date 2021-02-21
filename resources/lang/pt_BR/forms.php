<?php
$folder = '/Resources/lang/' . \App::getLocale() . '/forms.php';
$translates = [];
foreach ( \Module::all() as $module ) {
	$file = $module->getPath() . $folder;
	if(is_file($file)) {
		$translates[ snake_case( $module->getName() ) ] = require_once($file);
	}
}
return $translates;