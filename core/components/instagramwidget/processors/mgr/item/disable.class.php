<?php

/**
 * Disable an Item
 */
class InstagramWidgetItemDisableProcessor extends modObjectProcessor {
	public $objectType = 'InstagramWidgetItem';
	public $classKey = 'InstagramWidgetItem';
	public $languageTopics = array('instagramwidget');
	//public $permission = 'save';


	/**
	 * @return array|string
	 */
	public function process() {
		if (!$this->checkPermissions()) {
			return $this->failure($this->modx->lexicon('access_denied'));
		}

		$ids = $this->modx->fromJSON($this->getProperty('ids'));
		if (empty($ids)) {
			return $this->failure($this->modx->lexicon('instagramwidget_item_err_ns'));
		}

		foreach ($ids as $id) {
			/** @var InstagramWidgetItem $object */
			if (!$object = $this->modx->getObject($this->classKey, $id)) {
				return $this->failure($this->modx->lexicon('instagramwidget_item_err_nf'));
			}

			$object->set('active', false);
			$object->save();
		}

		return $this->success();
	}

}

return 'InstagramWidgetItemDisableProcessor';
