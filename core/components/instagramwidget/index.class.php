<?php

/**
 * Class InstagramWidgetMainController
 */
abstract class InstagramWidgetMainController extends modExtraManagerController {
	/** @var InstagramWidget $InstagramWidget */
	public $InstagramWidget;


	/**
	 * @return void
	 */
	public function initialize() {
		$corePath = $this->modx->getOption('instagramwidget_core_path', null, $this->modx->getOption('core_path') . 'components/instagramwidget/');
		require_once $corePath . 'model/instagramwidget/instagramwidget.class.php';

		$this->InstagramWidget = new InstagramWidget($this->modx);
		$this->addCss($this->InstagramWidget->config['cssUrl'] . 'mgr/main.css');
		$this->addJavascript($this->InstagramWidget->config['jsUrl'] . 'mgr/instagramwidget.js');
		$this->addHtml('
		<script type="text/javascript">
			InstagramWidget.config = ' . $this->modx->toJSON($this->InstagramWidget->config) . ';
			InstagramWidget.config.connector_url = "' . $this->InstagramWidget->config['connectorUrl'] . '";
		</script>
		');

		parent::initialize();
	}


	/**
	 * @return array
	 */
	public function getLanguageTopics() {
		return array('instagramwidget:default');
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
class IndexManagerController extends InstagramWidgetMainController {

	/**
	 * @return string
	 */
	public static function getDefaultController() {
		return 'home';
	}
}