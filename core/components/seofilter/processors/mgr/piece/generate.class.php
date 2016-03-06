<?php

/**
 * Generate an sfPiece
 */
class seoFilterPiecesGenerateProcessor extends modProcessor {
    public $objectType = 'sfPiece';
    public $classKey = 'sfPiece';
    public $languageTopics = array('seofilter');

    private $param;

    /**
     * Run the processor and return the result. Override this in your derivative class to provide custom functionality.
     * Used here for pre-2.2-style processors.
     *
     * @return mixed
     */
    public function process()
    {
        $paramId = $this->getProperty('param');
        if (empty($paramId) || !$this->param = $this->modx->getObject('sfParam', $paramId)) {
            return $this->failure($this->modx->lexicon('seofilter_request_error'));
        }

        // TODO: generate values
        return $this->failure('Упс! Функция в разработке!');

        return $this->success($paramId);
    }
}

return 'seoFilterPiecesGenerateProcessor';