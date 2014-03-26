<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Assetic\Factory\AssetFactory;
use Assetic\AssetManager;
use Assetic\FilterManager;
use Assetic\Asset\FileAsset;
use Assetic\Filter\UglifyJs2Filter;

$scripts = array(
	'jquery' => array('@jquery'),
	'collection' => array('@jquery', 'asset-collections.js'),
	'bootstrap' => array(
			'@jquery', 
			__DIR__ . '/../../vendor/twbs/bootstrap/js/transition.js',
			__DIR__ . '/../../vendor/twbs/bootstrap/js/alert.js',
			__DIR__ . '/../../vendor/twbs/bootstrap/js/button.js',
			__DIR__ . '/../../vendor/twbs/bootstrap/js/carousel.js',
			__DIR__ . '/../../vendor/twbs/bootstrap/js/collapse.js',
			__DIR__ . '/../../vendor/twbs/bootstrap/js/dropdown.js',
			__DIR__ . '/../../vendor/twbs/bootstrap/js/modal.js',
			__DIR__ . '/../../vendor/twbs/bootstrap/js/tooltip.js',
			__DIR__ . '/../../vendor/twbs/bootstrap/js/popover.js',
			__DIR__ . '/../../vendor/twbs/bootstrap/js/scrollspy.js',
			__DIR__ . '/../../vendor/twbs/bootstrap/js/tab.js',
			__DIR__ . '/../../vendor/twbs/bootstrap/js/affix.js'
	)
);

$assetManager = new AssetManager();
$assetManager->set('jquery', new FileAsset('jquery-1.11.0.js'));

$filterManager = new FilterManager();
$filterManager->set('uglify', new UglifyJs2Filter('/usr/local/bin/uglifyjs'));

$factory = new AssetFactory(__DIR__);
$factory->setAssetManager($assetManager);
$factory->setFilterManager($filterManager);

$requestedAsset = $_GET['script'];

if (!array_key_exists($requestedAsset, $scripts)) {
	header("HTTP/1.0 404 Not Found");
	exit();
}

if (isset($_GET['debug'])) {
	$factory->setDebug(boolval($_GET['debug']));
}

$script = $scripts[$requestedAsset];

$asset = $factory->createAsset($script, array('?uglify'));

header('Content-Type: application/javascript');
echo $asset->dump();

