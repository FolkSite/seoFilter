<?php

/**
 * Class seofilterMainController
 */
abstract class seofilterMainController extends modExtraManagerController {
	/** @var seofilter $seofilter */
	public $seofilter;


	/**
	 * @return void
	 */
	public function initialize() {
		$corePath = $this->modx->getOption('seofilter_core_path', null, $this->modx->getOption('core_path') . 'components/seofilter/');
		require_once $corePath . 'model/seofilter/seofilter.class.php';

		$this->seofilter = new seofilter($this->modx);
		//$this->addCss($this->seofilter->config['cssUrl'] . 'mgr/main.css');
		$this->addJavascript($this->seofilter->config['jsUrl'] . 'mgr/seofilter.js');
		$this->addHtml('
		<script type="text/javascript">
			seoFilter.config = ' . $this->modx->toJSON($this->seofilter->config) . ';
			seoFilter.config.connector_url = "' . $this->seofilter->config['connectorUrl'] . '";
		</script>
		');

		parent::initialize();
	}


	/**
	 * @return array
	 */
	public function getLanguageTopics() {
		return array('seofilter:default');
	}


	/**
	 * @return bool
	 */
	public function checkPermissions() {
		return true;
	}
}


/**
 * Class IndexManagerController
 */
class IndexManagerController extends seofilterMainController {

	/**
	 * @return string
	 */
	public static function getDefaultController() {
		return 'home';
	}
}