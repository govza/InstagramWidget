<?php
/** @noinspection PhpIncludeInspection */
require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/config.core.php';
/** @noinspection PhpIncludeInspection */
require_once MODX_CORE_PATH . 'config/' . MODX_CONFIG_KEY . '.inc.php';
/** @noinspection PhpIncludeInspection */
require_once MODX_CONNECTORS_PATH . 'index.php';
/** @var InstagramWidget $InstagramWidget */
$InstagramWidget = $modx->getService('instagramwidget', 'InstagramWidget', $modx->getOption('instagramwidget_core_path', null, $modx->getOption('core_path') . 'components/instagramwidget/') . 'model/instagramwidget/');
$modx->lexicon->load('instagramwidget:default');

// handle request
$corePath = $modx->getOption('instagramwidget_core_path', null, $modx->getOption('core_path') . 'components/instagramwidget/');
$path = $modx->getOption('processorsPath', $InstagramWidget->config, $corePath . 'processors/');
$modx->request->handleRequest(array(
	'processors_path' => $path,
	'location' => '',
));