<?php

$settings = array();

$tmp = array(

);

foreach ($tmp as $k => $v) {
	/* @var modSystemSetting $setting */
	$setting = $modx->newObject('modSystemSetting');
	$setting->fromArray(array_merge(
		array(
			'key' => 'instagramwidget_' . $k,
			'namespace' => PKG_NAME_LOWER,
			'area' => PKG_NAME_LOWER.'_main',
		), $v
	), '', true, true);

	$settings[] = $setting;
}

unset($tmp);
return $settings;
