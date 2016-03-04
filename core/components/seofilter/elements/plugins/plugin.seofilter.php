<?php
if ($modx->event->name == 'OnPageNotFound') {
    /** @var array $scriptProperties */
    /** @var seoFilter $seoFilter */
    if (!$seoFilter = $modx->getService('seoFilter', 'seoFilter', $modx->getOption('seofilter_core_path', null, $modx->getOption('core_path') . 'components/seofilter/') . 'model/seofilter/', $scriptProperties)) {
        return 'Could not load seoFilter class!';
    }

    $resourceId = $seoFilter->processUri();
    if ($resourceId) {
        // Есть такая виртульная страница, подсовывем ее юзеру
        $seoFilter->supersedeCategoryFilterContent($resourceId);
        $modx->sendForward($resourceId);
    }
}

if($modx->event->name == 'OnLoadWebDocument') {
    if($modx->getPlaceholder('seo_filter_supersede')) {
        // Делаем ресурс не кэшируемым
        $modx->resource->set('cacheable', 0);
        // подменяем поля с текстом
        $modx->resource->set($modx->getOption('seofilter_text1_default_field'), $modx->getPlaceholder('seo_filter_supersede_text1'));
        $modx->resource->set($modx->getOption('seofilter_text2_default_field'), $modx->getPlaceholder('seo_filter_supersede_text2'));
    }
}