<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Assetic\Factory\AssetFactory;
use Assetic\AssetManager;
use Assetic\Asset\FileAsset;

$scripts = array(
	'jquery' => array('@jquery'),
	'collection' => array('@jquery', 'asset-collection.js'),
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

$manager = new AssetManager();
$manager->set('jquery', new FileAsset('jquery-1.11.0.js'));

$factory = new AssetFactory(__DIR__);
$factory->setAssetManager($manager);

$requestedAsset = $_GET['script'];

if (!array_key_exists($requestedAsset, $scripts)) {
	header("HTTP/1.0 404 Not Found");
	exit();
}

$script = $scripts[$requestedAsset];

$asset = $factory->createAsset($script);

header('Content-Type: application/javascript');
echo $asset->dump();

