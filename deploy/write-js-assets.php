<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Assetic\Factory\AssetFactory;
use Assetic\AssetManager;
use Assetic\FilterManager;
use Assetic\AssetWriter;
use Assetic\Asset\FileAsset;
use Assetic\Filter\UglifyJs2Filter;

$scripts = array(
	'jquery' => array('@jquery'),
	'collection' => array('@jquery', 'asset-collections.js'),
	'bootstrap' => array(
			'@jquery', 
			__DIR__ . '/../vendor/twbs/bootstrap/js/transition.js',
			__DIR__ . '/../vendor/twbs/bootstrap/js/alert.js',
			__DIR__ . '/../vendor/twbs/bootstrap/js/button.js',
			__DIR__ . '/../vendor/twbs/bootstrap/js/carousel.js',
			__DIR__ . '/../vendor/twbs/bootstrap/js/collapse.js',
			__DIR__ . '/../vendor/twbs/bootstrap/js/dropdown.js',
			__DIR__ . '/../vendor/twbs/bootstrap/js/modal.js',
			__DIR__ . '/../vendor/twbs/bootstrap/js/tooltip.js',
			__DIR__ . '/../vendor/twbs/bootstrap/js/popover.js',
			__DIR__ . '/../vendor/twbs/bootstrap/js/scrollspy.js',
			__DIR__ . '/../vendor/twbs/bootstrap/js/tab.js',
			__DIR__ . '/../vendor/twbs/bootstrap/js/affix.js'
	)
);

$assetManager = new AssetManager();
$assetManager->set('jquery', new FileAsset(__DIR__ . '/../src/javascripts/jquery-1.11.0.js'));

$filterManager = new FilterManager();
$filterManager->set('uglify', new UglifyJs2Filter('/usr/local/bin/uglifyjs'));

$factory = new AssetFactory(__DIR__ . '/../src/javascripts');
$factory->setAssetManager($assetManager);
$factory->setFilterManager($filterManager);
$factory->setDefaultOutput('*.js');

$jsWriter = new AssetWriter(__DIR__ . '/../public/js');
foreach ($scripts as $script => $files) {
	$jsWriter->writeAsset($factory->createAsset($files, array('uglify'), array('name' => $script)));
}
