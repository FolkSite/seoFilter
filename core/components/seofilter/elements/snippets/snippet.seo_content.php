<?php

// С каким полем будем работать?
$field = empty($field) ? 'content' : $field;

// проверка текущей страницы
$pageVarKey = empty($pageVarKey) ? 'page' : $pageVarKey;
$isPage = isset($_GET[$pageVarKey]);
// если мы на странице X и выставлена настройка - текст скрывается
if($isPage && $modx->getOption("seofilter_hide_".$field."_on_page_x", null, true)) {
    return '';
}

// определяем сам ресурс..
if(empty($resource)) {
    $resource = &$modx->resource;
}
else {
    $resource = $modx->getObject('modResource', intval($resource));
}
// ..значение поля
$content = $resource->get($field);

// мы на странице сео фильтра?
$isSeoFilterPage = intval($modx->getPlaceholder('seo_filters_count')) > 0;

// в содержимом поля есть сео плейсхолдер?
$hasFilterPlaceholder = false;
if($isSeoFilterPage) {
    $hasFilterPlaceholder = (strpos("+seo_filter_", $content) === false) ? false : true;
}

// если это сео фильтр..
if($isSeoFilterPage) {
    // ..и есть плейсхолдер - проверяем сист. настройку и скрываем поле, если надо
    if($hasFilterPlaceholder && $modx->getOption("seofilter_hide_".$field."_on_seo_filter_with_placeholder", null, false)) {
        return '';
    }
    // ..проверяем другую сист. настройку и скрываем поле, если надо
    elseif($modx->getOption("seofilter_hide_".$field."_on_seo_filter", null, true)) {
        return '';
    }
}

return $content;