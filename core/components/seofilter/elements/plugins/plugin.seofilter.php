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
        $modx->sendForward($resourceId);
    }
}

// Иначе ничего не делаем и юзер получает 404 или его перехватывает другой плагин.