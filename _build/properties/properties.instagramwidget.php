<?php

$properties = array();

$tmp = array(
	'wrapper' => array(
		'type' => 'textfield',
		'value' => 'tpl.InstagramWidget.wrapper',
	),
	'tpl' => array(
		'type' => 'textfield',
		'value' => 'tpl.InstagramWidget.row',
	),
	'width' => array(
		'type' => 'textfield',
		'value' => '260px',
	),
	'limit' => array(
		'type' => 'numberfield',
		'value' => 12,
	),
	'inLine' => array(
		'type' => 'numberfield',
		'value' => 4,
	),
	'cacheExpTime' => array(
		'type' => 'numberfield',
		'value' => 6,
	),
	'login' => array(
		'xtype' => 'textfield',
		'value' => 'govza',
	),
	'id' => array(
		'xtype' => 'textfield',
		'value' => '5139563e76d34551810efe80764b4557',
	),
	'hashtag' => array(
		'xtype' => 'textfield',
		'value' => '',
	),
	'cssFile' => array(
		'xtype' => 'textfield',
		'value' => '/components/instagramwidget/css/instagramwidget.css',
	),
	'random' => array(
		'xtype' => 'combo-boolean',
		'value' => true,
	),
	'imageSize' => array(
		'type' => 'list',
		'options' => array(
			array('text' => 'small', 'value' => 'small'),
			array('text' => 'large', 'value' => 'large'),
			array('text' => 'fullsize', 'value' => 'fullsize'),
		),
		'value' => 'small'
	),

);

foreach ($tmp as $k => $v) {
	$properties[] = array_merge(
		array(
			'name' => $k,
			'desc' => PKG_NAME_LOWER . '_prop_' . $k,
			'lexicon' => PKG_NAME_LOWER . ':properties',
		), $v
	);
}

return $properties;