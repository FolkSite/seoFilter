<?php

$properties = array();

$tmp = array(
	'pageVarKey' => array(
		'type' => 'textfield',
		'value' => 'page',
	),
	'field' => array(
		'type' => 'textfield',
		'value' => 'content',
	),
	'resource' => array(
		'type' => 'textfield',
		'value' => ''
	),
);

foreach ($tmp as $k => $v) {
	$properties[] = array_merge(
		array(
			'name' => $k,
			'desc' => PKG_NAME_LOWER . '_prop_' . $k,
			'lexicon' => PKG_NAME_LOWER . ':properties',
		), $v
	);
}

return $properties;