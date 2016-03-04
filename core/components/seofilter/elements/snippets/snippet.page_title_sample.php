<?php

// проверяем, нет ли ручной установки заголовка страницы
if($modx->getPlaceholder('seo_filter_supersede')) {
    return $modx->getPlaceholder('seo_filter_supersede_pagetitle');
}

if(empty($resource)) {
    $resource = & $modx->resource;
}
else {
    $resource = $modx->getObject('modResource', intval($resource));
}

if(!$resource) {
    return '';
}

$result = $resource->get("longtitle");
if(empty($result)){
    $result = $resource->get("pagetitle");
}

$seo_filter_title = $modx->getPlaceholder('seo_filter_title');
if(!empty($seo_filter_title)) {
    $result .= ' '.htmlspecialchars($seo_filter_title);
}

return $result;