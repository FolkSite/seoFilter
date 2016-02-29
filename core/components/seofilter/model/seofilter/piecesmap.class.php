<?php

/**
* The base class for piecesMap
*/
class piecesMap {
/* @var modX $modx */
    public $modx;

    private $paramsMap = array();
    private $piecesMap = array();
    private $mapsLoaded = false;

    function __construct(modX &$modx) {
        $this->modx =& $modx;
    }

    private function loadMap() {
        $paramId2Name = array();

        $q = $this->modx->newQuery('sfParam');
        $q->select($this->modx->getSelectColumns('sfParam', 'sfParam'));
        if ($q->prepare() && $q->stmt->execute()) {
            $rows = $q->stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach($rows as $row) {
                $this->paramsMap[$row['name']] = array(
                    'id' => $row['id'],
                    'pieces' => array(),
                );
                $paramId2Name[$row['id']] = $row['name'];
            }
        }

        $q = $this->modx->newQuery('sfPiece');
        $q->select($this->modx->getSelectColumns('sfPiece', 'sfPiece'));

        if ($q->prepare() && $q->stmt->execute()) {
            $rows = $q->stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach($rows as $row) {
                if(!empty($row['alias'])) {
                    $this->piecesMap[$row['value']] = array(
                        'id' => $row['id'],
                        'param_id' => $row['param'],
                        'param' => $paramId2Name[$row['param']],
                        'alias' => $row['alias'],
                        'correction' => $row['correction'],
                    );
                }
            }
        }

        $this->mapsLoaded = true;
    }

    public function getAlias($param, $value) {
        if(!$this->mapsLoaded) {
            $this->loadMap();
        }

        if(array_key_exists($value, $this->piecesMap) && $this->piecesMap[$value]['param'] == $param) {
            return $this->piecesMap[$value]['alias'];
        }
        return '';
    }

    public function getPieceData($alias){
        if(empty($alias)) {
            return null;
        }

        if(!$this->mapsLoaded) {
            $this->loadMap();
        }


        foreach($this->piecesMap as $pieceValue => $pieceData) {
            if($pieceData['alias'] == $alias) {

                return array(
                    'param' => $pieceData['param'],
                    'value' => $pieceValue,
                    'title' => !empty($pieceData['correction']) ? $pieceData['correction'] : $pieceValue,
                );
            }
        }

        return null;
    }
}