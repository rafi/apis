<?php defined('SYSPATH') or die('No direct script access.');

Route::set('apidemo', 'demo/<controller>(/<demo>)')
	->defaults(array(
		'directory' => 'demo',
		'action' => 'api',
	));
