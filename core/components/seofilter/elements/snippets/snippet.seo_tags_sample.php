<?php

if(empty($resource)) {
    $resource = & $modx->resource;
}
else {
    $resource = $modx->getObject('modResource', intval($resource));
}

$sitename = $modx->getOption('site_name');

$pagetitle = htmlspecialchars($resource->get("pagetitle"));
$longtitle = htmlspecialchars($resource->get("longtitle"));
$seotitle = htmlspecialchars($resource->getTVValue("seoTitle"));
$template = $resource->get("template");

$title = '';
$keywords = $resource->getTVValue("seoKeywords");
$description = $resource->getTVValue("seoDescription");
$addSiteName = false;

$smartTitle = $longtitle;
if(empty($smartTitle)) {
    $smartTitle = $pagetitle;
}

$seo_filter_title = $modx->getPlaceholder('seo_filter_title');
if(!empty($seo_filter_title)) {
    $smartTitle .= ' '.htmlspecialchars($seo_filter_title);
}

$title = $smartTitle;
if(!empty($seotitle)) {
    $title = $seotitle;
}

switch($template) {
    default:
        $addSiteName = true;
        break;
}

if($addSiteName) {
    $title = $title.'. '.$sitename;
}

if(empty($keywords)) {
    $keywords = $smartTitle;
}
if(empty($description)) {
    $description = $smartTitle.'. '.$sitename;
}

$modx->setPlaceholder('seoTitle', $title);
$modx->setPlaceholder('seoKeywords', $keywords);
$modx->setPlaceholder('seoDescription', $description);

return '';