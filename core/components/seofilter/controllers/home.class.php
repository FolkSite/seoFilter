<?php

/**
 * The home manager controller for seofilter.
 *
 */
class seofilterHomeManagerController extends seofilterMainController {
	/* @var seofilter $seofilter */
	public $seofilter;


	/**
	 * @param array $scriptProperties
	 */
	public function process(array $scriptProperties = array()) {
	}


	/**
	 * @return null|string
	 */
	public function getPageTitle() {
		return $this->modx->lexicon('seofilter');
	}


	/**
	 * @return void
	 */
	public function loadCustomCssJs() {
		$this->addCss($this->seofilter->config['cssUrl'] . 'mgr/main.css');
		$this->addCss($this->seofilter->config['cssUrl'] . 'mgr/bootstrap.buttons.css');
		$this->addJavascript($this->seofilter->config['jsUrl'] . 'mgr/misc/utils.js');
        $this->addJavascript($this->seofilter->config['jsUrl'] . 'mgr/misc/combos.js');
		$this->addJavascript($this->seofilter->config['jsUrl'] . 'mgr/widgets/params.grid.js');
		$this->addJavascript($this->seofilter->config['jsUrl'] . 'mgr/widgets/params.windows.js');
        $this->addJavascript($this->seofilter->config['jsUrl'] . 'mgr/widgets/pieces.grid.js');
        $this->addJavascript($this->seofilter->config['jsUrl'] . 'mgr/widgets/pieces.windows.js');
		$this->addJavascript($this->seofilter->config['jsUrl'] . 'mgr/widgets/home.panel.js');
		$this->addJavascript($this->seofilter->config['jsUrl'] . 'mgr/sections/home.js');
		$this->addHtml('<script type="text/javascript">
		Ext.onReady(function() {
			MODx.load({ xtype: "seofilter-page-home"});
		});
		</script>');
	}


	/**
	 * @return string
	 */
	public function getTemplateFile() {
		return $this->seofilter->config['templatesPath'] . 'home.tpl';
	}
}