<?php
/** @noinspection PhpIncludeInspection */
require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/config.core.php';
/** @noinspection PhpIncludeInspection */
require_once MODX_CORE_PATH . 'config/' . MODX_CONFIG_KEY . '.inc.php';
/** @noinspection PhpIncludeInspection */
require_once MODX_CONNECTORS_PATH . 'index.php';
/** @var seofilter $seofilter */
$seofilter = $modx->getService('seofilter', 'seofilter', $modx->getOption('seofilter_core_path', null, $modx->getOption('core_path') . 'components/seofilter/') . 'model/seofilter/');
$modx->lexicon->load('seofilter:default');

// handle request
$corePath = $modx->getOption('seofilter_core_path', null, $modx->getOption('core_path') . 'components/seofilter/');
$path = $modx->getOption('processorsPath', $seofilter->config, $corePath . 'processors/');
$modx->request->handleRequest(array(
	'processors_path' => $path,
	'location' => '',
));