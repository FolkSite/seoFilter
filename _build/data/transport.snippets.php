<?php

$snippets = array();

$tmp = array(
	'sfGetAlias' => array(
		'file' => 'sf_get_alias',
		'description' => '',
	),
    'pageTitle.Sample' => array(
        'file' => 'page_title_sample',
        'description' => 'Пример сниппета pageTitle. Скопируйте этот сниппет для дальнейшего использования.',
    ),
    'seoTags.Sample' => array(
        'file' => 'seo_tags_sample',
        'description' => "Пример сниппета seoTags. Скопируйте этот сниппет для дальнейшего использования.\n\n В чанках используйте плейсхолдеры [[!+seoTitle]], [[!+seoDescription]], [[!+seoKeywords]]",
    ),
);

foreach ($tmp as $k => $v) {
	/* @avr modSnippet $snippet */
	$snippet = $modx->newObject('modSnippet');
	$snippet->fromArray(array(
		'id' => 0,
		'name' => $k,
		'description' => @$v['description'],
		'snippet' => getSnippetContent($sources['source_core'] . '/elements/snippets/snippet.' . $v['file'] . '.php'),
		'static' => BUILD_SNIPPET_STATIC,
		'source' => 1,
		'static_file' => 'core/components/' . PKG_NAME_LOWER . '/elements/snippets/snippet.' . $v['file'] . '.php',
	), '', true, true);

	$properties = include $sources['build'] . 'properties/properties.' . $v['file'] . '.php';
	$snippet->setProperties($properties);

	$snippets[] = $snippet;
}

unset($tmp, $properties);
return $snippets;