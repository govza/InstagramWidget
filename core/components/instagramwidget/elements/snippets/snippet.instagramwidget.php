<?php
/** @var array $scriptProperties */
/** @var InstagramWidget $InstagramWidget */
if (!$InstagramWidget = $modx->getService('instagramwidget', 'InstagramWidget', $modx->getOption('instagramwidget_core_path', null, $modx->getOption('core_path') . 'components/instagramwidget/') . 'model/instagramwidget/', $scriptProperties)) {
return 'Could not load InstagramWidget class!';
}

$tpl = $modx->getOption('tpl',$scriptProperties,'tpl.InstagramWidget.row');
$wrapper = $modx->getOption('wrapper',$scriptProperties,'tpl.InstagramWidget.wrapper');
$cssFile = $modx->getOption('cssFile',$scriptProperties,'');

if ($cssFile != '') {
	$modx->regClientCSS(MODX_ASSETS_URL . $cssFile);
	$width = $modx->getOption('width',$scriptProperties,'260px');
	$inLine = $modx->getOption('inLine',$scriptProperties,4);
	if (strpos($width, '%') == true) {$textAttr = 'width:'.$width;}
	else if(str_replace('px','',$width)<160) {$textAttr = 'display:none';}
	else {$textAttr ='width:'.(str_replace('px','',$width)-44).'px';}
	if (strpos($width, '%') == false) {
		$imgWidth = round((str_replace('px','',$width)-(17+(9*$inLine)))/$inLine);
		$imgStyle = 'width:'.$imgWidth.'px; height:'.$imgWidth.'px';

	}
	if ($cssFile == '/components/instagramwidget/css/instagramwidget.css') {
		$modx->regClientStartupHTMLBlock('
		<style type="text/css">
			.instagramwidget {width:' . $width . '}
			.instagramwidget .title .text {' . $textAttr . '}
			.instagramwidget .data .image {' . $imgStyle . '}
			.instagramwidget .data .image img{' . $imgStyle . '}
		</style>
		');
	}
}

$InstagramWidget = new InstagramWidget($modx, $scriptProperties);

$cacheFolderUrl = MODX_BASE_URL . str_replace(MODX_BASE_PATH, '', $InstagramWidget->config['cacheFile']);

$InstagramWidget->getData();
$inImagesArray = array();
$view = $modx->getOption('limit',$scriptProperties,12);
$random = $modx->getOption('random',$scriptProperties,0);
$preview = $modx->getOption('imageSize',$scriptProperties,'small');


if($random == 1) {shuffle($InstagramWidget->data->images);}

$InstagramWidget->data->images = array_slice($InstagramWidget->data->images,0,$view);
foreach ($InstagramWidget->data->images as $key=>$item){
	switch ($preview){
		case 'large':
			$thumbnail = $item->large;
			break;
		case 'fullsize':
			$thumbnail = $item->fullsize;
			break;
		default:
			$thumbnail = $item->small;
	}
	$inImagesArray[] = $modx->getChunk($tpl, array('link' => $item->link, 'src' => $thumbnail));
}
$inImages =  implode ($inImagesArray);

$output .= $modx->getChunk($wrapper,
	array(
		'inLink'=>'http://instagram.com/'.$InstagramWidget->data->username,
		'inUser'=>$InstagramWidget->data->username,
		'inAvatar'=>$InstagramWidget->data->avatar,
		'inPosts'=>$InstagramWidget->data->posts,
		'inFollowers'=>$InstagramWidget->data->followers,
		'inFollowing'=>$InstagramWidget->data->following,
		'inImages'=>$inImages
	));

return $output;