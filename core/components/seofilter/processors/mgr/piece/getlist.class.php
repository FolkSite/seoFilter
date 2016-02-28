<?php

/**
 * Get a list of sfPiece
 */
class seoFilterPieceGetListProcessor extends modObjectGetListProcessor {
	public $objectType = 'sfPiece';
	public $classKey = 'sfPiece';
	public $defaultSortField = 'value';
	public $defaultSortDirection = 'ASC';
	//public $permission = 'list';


	/**
	 * * We doing special check of permission
	 * because of our objects is not an instances of modAccessibleObject
	 *
	 * @return boolean|string
	 */
	public function beforeQuery() {
		if (!$this->checkPermissions()) {
			return $this->modx->lexicon('access_denied');
		}

		return true;
	}


	/**
	 * @param xPDOQuery $c
	 *
	 * @return xPDOQuery
	 */
	public function prepareQueryBeforeCount(xPDOQuery $c) {
        $c->leftJoin('sfParam','Param','`sfPiece`.`param` = `Param`.`id`');
        $c->select($this->modx->getSelectColumns($this->classKey, $this->classKey, ''));
        $c->select('`Param`.`name` as `param_name`');

		$query = trim($this->getProperty('query'));
		if ($query) {
			$c->where(array(
				'value:LIKE' => "%{$query}%",
                'OR:alias:LIKE' => "%{$query}%",
			));
		}

		return $c;
	}


	/**
	 * @param xPDOObject $object
	 *
	 * @return array
	 */
	public function prepareRow(xPDOObject $object) {
		$array = $object->toArray();
		$array['actions'] = array();

		// Edit
		$array['actions'][] = array(
			'cls' => '',
			'icon' => 'icon icon-edit',
			'title' => $this->modx->lexicon('seofilter_piece_update'),
			//'multiple' => $this->modx->lexicon('seofilter_pieces_update'),
			'action' => 'updatePiece',
			'button' => true,
			'menu' => true,
		);

		// Remove
		$array['actions'][] = array(
			'cls' => '',
			'icon' => 'icon icon-trash-o action-red',
			'title' => $this->modx->lexicon('seofilter_piece_remove'),
			'multiple' => $this->modx->lexicon('seofilter_pieces_remove'),
			'action' => 'removePiece',
			'button' => true,
			'menu' => true,
		);

		return $array;
	}

}

return 'seoFilterPieceGetListProcessor';