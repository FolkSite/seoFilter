<?php

if ($modx->event->name != 'OnPageNotFound') {
    return;
}

$alias = $modx->context->getOption('request_param_alias', 'q');
if (!isset($_REQUEST[$alias])) {
    return;
}

$container_suffix = $modx->context->getOption('container_suffix', '');

$request = $page = trim($_REQUEST[$alias], "/");
$pieces = explode('/', $request);

for ($i = count($pieces); $i > 0; $i--) {
    // Определяем id раздела.
    if ($section = $modx->findResource($page.$container_suffix)) {
        break;
    }
    $page = trim(str_replace($pieces[$i-1], '', $page), "/");
}

if (!$section) {
    return;
}

/** @var array $scriptProperties */
/** @var seoFilter $seoFilter */
if (!$seoFilter = $modx->getService('seoFilter', 'seoFilter', $modx->getOption('seofilter_core_path', null, $modx->getOption('core_path') . 'components/seofilter/') . 'model/seofilter/', $scriptProperties)) {
    return 'Could not load seoFilter class!';
}

$pieces = explode('/', trim(str_replace($page, '', $request), '/'));

$check = false; // Обнуляем проверку
foreach ($pieces as $piece) {
    if (empty($piece)){
        return;
    }

    $pieceData = $seoFilter->getParamValueByAlias($piece);
    if(!$pieceData) {
        return;
    }
    $param = $pieceData['param'];
    $value = $pieceData['value'];
    $title = $pieceData['title'];

    // устанавливаем плейсхолдер
    $modx->setPlaceHolder('seo_filter_'.$param, $title);

    // Осталось выставить нужные переменные в запрос, как будто юзер их сам указал
    $_GET[$param] = $value;
    $_POST[$param] = $value;
    $_REQUEST[$param] = $value;

    $check = true;
}

// Есть ли параметры
if ($check) {
    // А теперь подсовывем юзеру страницу, а дальше сниппет на ней сам разберётся
    $modx->sendForward($section);
}
// Иначе ничего не делаем и юзер получает 404 или его перехватывает другой плагин.