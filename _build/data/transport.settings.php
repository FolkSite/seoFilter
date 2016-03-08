<?php

$settings = array();

$tmp = array(
	'max_depth' => array(
		'xtype' => 'numberfield',
		'value' => 1,
		'area' => 'seofilter_main',
	),
    'text1_default_field' => array(
        'xtype' => 'textfield',
        'value' => 'introtext',
        'area' => 'seofilter_main',
    ),
    'text2_default_field' => array(
        'xtype' => 'textfield',
        'value' => 'content',
        'area' => 'seofilter_main',
    ),
    'show_text1' => array(
        'xtype' => 'combo-boolean',
        'value' => true,
        'area' => 'seofilter_main',
    ),
    'show_text2' => array(
        'xtype' => 'combo-boolean',
        'value' => true,
        'area' => 'seofilter_main',
    ),
    'disable_meta_on_page_x' => array(
        'xtype' => 'combo-boolean',
        'value' => true,
        'area' => 'seofilter_main',
    ),
);

foreach ($tmp as $k => $v) {
	/* @var modSystemSetting $setting */
	$setting = $modx->newObject('modSystemSetting');
	$setting->fromArray(array_merge(
		array(
			'key' => 'seofilter_' . $k,
			'namespace' => PKG_NAME_LOWER,
		), $v
	), '', true, true);

	$settings[] = $setting;
}

unset($tmp);
return $settings;
