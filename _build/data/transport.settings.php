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
        'area' => 'seofilter_meta_and_text',
    ),
    'text2_default_field' => array(
        'xtype' => 'textfield',
        'value' => 'content',
        'area' => 'seofilter_meta_and_text',
    ),
    'disable_meta_paging' => array(
        'xtype' => 'combo-boolean',
        'value' => true,
        'area' => 'seofilter_meta_and_text',
    ),

    'hide_introtext_paging' => array(
        'xtype' => 'combo-boolean',
        'value' => true,
        'area' => 'seofilter_meta_and_text',
    ),
    'hide_content_paging' => array(
        'xtype' => 'combo-boolean',
        'value' => true,
        'area' => 'seofilter_meta_and_text',
    ),
    'hide_introtext_on_seo_filter' => array(
        'xtype' => 'combo-boolean',
        'value' => true,
        'area' => 'seofilter_meta_and_text',
    ),
    'hide_content_on_seo_filter' => array(
        'xtype' => 'combo-boolean',
        'value' => true,
        'area' => 'seofilter_meta_and_text',
    ),
    'hide_introtext_on_seo_filter_pls' => array(
        'xtype' => 'combo-boolean',
        'value' => false,
        'area' => 'seofilter_meta_and_text',
    ),
    'hide_content_on_seo_filter_pls' => array(
        'xtype' => 'combo-boolean',
        'value' => false,
        'area' => 'seofilter_meta_and_text',
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
